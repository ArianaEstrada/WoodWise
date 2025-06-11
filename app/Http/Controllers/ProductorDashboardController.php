<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Parcela;
use App\Models\Troza;
use App\Models\Estimacion;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class ProductorDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $parcelas = Parcela::with(['trozas', 'trozas.estimacion'])
            ->where('id_productor', $userId)
            ->orderBy('nom_parcela')
            ->get();

        $stats = [
            'total_parcelas' => $parcelas->count(),
            'total_trozas' => $parcelas->sum(function($parcela) {
                return $parcela->trozas->count();
            }),
            'total_estimaciones' => $parcelas->sum(function($parcela) {
                return $parcela->trozas->sum(function($troza) {
                    return $troza->estimacion ? 1 : 0;
                });
            }),
            'ultima_actualizacion' => now()->format('d/m/Y H:i')
        ];

        return view('P.index', compact('parcelas', 'stats'));
    }

    public function exportarGeneral()
    {
        $userId = Auth::id();

        // Obtener todas las parcelas del productor con sus relaciones
        $parcelas = Parcela::with(['trozas', 'trozas.estimacion'])
            ->where('id_productor', $userId)
            ->orderBy('nom_parcela')
            ->get();

        // Verificar si hay datos para exportar
        if ($parcelas->isEmpty()) {
            return redirect()->back()
                ->with('error', 'No hay datos disponibles para generar el reporte.');
        }

        $data = [
            'parcelas' => $parcelas,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'titulo' => 'Reporte General del Productor',
            'logo' => public_path('images/logo.png'),
            'stats' => [
                'total_parcelas' => $parcelas->count(),
                'total_trozas' => $parcelas->sum(function($parcela) {
                    return $parcela->trozas->count();
                }),
                'total_estimaciones' => $parcelas->sum(function($parcela) {
                    return $parcela->trozas->sum(function($troza) {
                        return $troza->estimacion ? 1 : 0;
                    });
                }),
            ]
        ];

        try {
            $pdf = PDF::loadView('P.pdf_export_general', $data)
                ->setPaper('a4', 'landscape')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'sans-serif',
                    'chroot' => public_path()
                ]);

            return $pdf->download('reporte_general_' . now()->format('Y-m-d') . '.pdf');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ocurrió un error al generar el reporte: ' . $e->getMessage());
        }
    }


    public function generarPdfTroza($id)
    {
        $userId = Auth::id();
        $parcelasIds = Parcela::where('id_productor', $userId)->pluck('id_parcela');

        $troza = Troza::with(['parcela', 'estimacion'])
            ->where('id_troza', $id)
            ->whereIn('id_parcela', $parcelasIds)
            ->firstOrFail();

        $data = [
            'troza' => $troza,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'logo' => public_path('images/logo.png')
        ];

        $pdf = PDF::loadView('P.troza', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('reporte_troza_' . $troza->id_troza . '.pdf');
    }
    public function generarPdfEstimacion($id)
    {
        $userId = Auth::id();
        $parcelasIds = Parcela::where('id_productor', $userId)->pluck('id_parcela');
        $trozasIds = Troza::whereIn('id_parcela', $parcelasIds)->pluck('id_troza');

        $estimacion = Estimacion::with(['troza.parcela'])
            ->where('id_estimacion', $id)
            ->whereIn('id_troza', $trozasIds)
            ->firstOrFail();

        $data = [
            'estimacion' => $estimacion,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'logo' => public_path('images/logo.png')
        ];

        $pdf = PDF::loadView('P.estimacion', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('reporte_estimacion_' . $estimacion->id_estimacion . '.pdf');
    }
}
