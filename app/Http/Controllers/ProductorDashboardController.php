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

        $parcelas = Parcela::with(['trozas', 'trozas.estimaciones'])
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
                    return $troza->estimaciones->count();
                });
            }),
            'ultima_actualizacion' => now()->format('d/m/Y H:i')
        ];

        return view('P.index', compact('parcelas', 'stats'));
    }

    public function exportarParcelas()
    {
        $userId = Auth::id();
        $parcelas = Parcela::where('id_productor', $userId)
            ->orderBy('nom_parcela')
            ->get();

        $data = [
            'parcelas' => $parcelas,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'titulo' => 'Reporte de Parcelas',
            'logo' => public_path('images/logo.png')
        ];

        $pdf = PDF::loadView('P.pdf_export', $data)
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('reporte_parcelas_' . now()->format('Ymd') . '.pdf');
    }

    public function exportarTrozas()
    {
        $userId = Auth::id();
        $parcelasIds = Parcela::where('id_productor', $userId)->pluck('id_parcela');

        $trozas = Troza::with('parcela')
            ->whereIn('id_parcela', $parcelasIds)
            ->orderBy('id_parcela')
            ->get();

        $data = [
            'trozas' => $trozas,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'titulo' => 'Reporte de Trozas',
            'logo' => public_path('images/logo.png')
        ];

        $pdf = PDF::loadView('P.pdf_export_trozas', $data)
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('reporte_trozas_' . now()->format('Ymd') . '.pdf');
    }

    public function exportarEstimaciones()
    {
        $userId = Auth::id();
        $parcelasIds = Parcela::where('id_productor', $userId)->pluck('id_parcela');
        $trozasIds = Troza::whereIn('id_parcela', $parcelasIds)->pluck('id_troza');

        // Modificado para usar created_at si fecha_estimacion no existe
        $estimaciones = Estimacion::with('troza.parcela')
            ->whereIn('id_troza', $trozasIds)
            ->orderBy('created_at') // Cambiado de fecha_estimacion a created_at
            ->get();

        $data = [
            'estimaciones' => $estimaciones,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'titulo' => 'Reporte de Estimaciones',
            'logo' => public_path('images/logo.png')
        ];

        $pdf = PDF::loadView('P.pdf_export_estimaciones', $data)
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('reporte_estimaciones_' . now()->format('Ymd') . '.pdf');
    }

    public function generarPdfParcela($id)
    {
        $userId = Auth::id();

        $parcela = Parcela::with('trozas.estimaciones')
            ->where('id_parcela', $id)
            ->where('id_productor', $userId)
            ->firstOrFail();

        $data = [
            'parcela' => $parcela,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'logo' => public_path('images/logo.png')
        ];

        $pdf = PDF::loadView('P.pdf_parcela', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('reporte_parcela_' . $parcela->nom_parcela . '.pdf');
    }

    public function generarPdfTroza($id)
    {
        $userId = Auth::id();

        $parcelasIds = Parcela::where('id_productor', $userId)->pluck('id_parcela');

        $troza = Troza::with(['parcela', 'estimaciones'])
            ->where('id_troza', $id)
            ->whereIn('id_parcela', $parcelasIds)
            ->firstOrFail();

        $data = [
            'troza' => $troza,
            'fecha' => Carbon::now()->format('d/m/Y'),
            'logo' => public_path('images/logo.png')
        ];

        $pdf = PDF::loadView('P.pdf_troza', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download('reporte_troza_' . $troza->id_troza . '.pdf');
    }
}
