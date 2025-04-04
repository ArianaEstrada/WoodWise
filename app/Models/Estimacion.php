<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimacion extends Model
{
    use HasFactory;

    protected $table = 'estimaciones';
    protected $primaryKey = 'id_estimacion';
    protected $fillable = [
        'id_tipo_e',
        'id_formula',
        'calculo',
        'id_troza',
    ];

    // Método para calcular automáticamente según la fórmula seleccionada
    public static function calcularEstimacion($id_formula, $id_troza)
    {
        $troza = Troza::findOrFail($id_troza);
        $formula = Formula::findOrFail($id_formula);
        
        switch ($formula->nom_formula) {
            case 'Formula de HUMBER':
                return self::calcularHumber($troza);

                case 'Formula de SMALIAN':
                    return self::calcularSmalian($troza);

                    case 'Formula de NEWTON':
                        return self::calcularNewton($troza);
            default:
                return null;
        }
    }
    public static function calcularSmalian($troza)
{
    if (!$troza->diametro || !$troza->longitud) {
        return null;
    }
    
    // Fórmula de Smalian: v = (A1 + A2)/2 * L
    $area1 = pi() * pow($troza->diametro, 2) / 4; // Área en un extremo
    $area2 = pi() * pow($troza->diametro_otro_extremo, 2) / 4; // Necesitarías este campo
    
    return (($area1 + $area2) / 2) * $troza->longitud;
}

public static function calcularNewton($troza)
{
    if (!$troza->diametro || !$troza->diametro_medio || !$troza->longitud) {
        return null;
    }
    
    // Fórmula de Newton: v = (A1 + 4Am + A2)/6 * L
    $area1 = pi() * pow($troza->diametro, 2) / 4;
    $area_medio = pi() * pow($troza->diametro_medio, 2) / 4;
    $area2 = pi() * pow($troza->diametro_otro_extremo, 2) / 4;
    
    return (($area1 + (4 * $area_medio) + $area2) / 6 * $troza->longitud);
}

    // Método específico para la fórmula de Humber
    public static function calcularHumber($troza)
    {
        if (!$troza->diametro || !$troza->longitud) {
            return null;
        }
        
        // Fórmula que produce 0.095 m³ para D=1.09m y L=1m
        return round(($troza->longitud * pow($troza->diametro, 2)) / (4 * pi()), 4);
    }

    // Relaciones
    public function tipoEstimacion()
    {
        return $this->belongsTo(Tipo_Estimacion::class, 'id_tipo_e');
    }

    public function formula()
    {
        return $this->belongsTo(Formula::class, 'id_formula');
    }

    public function troza()
    {
        return $this->belongsTo(Troza::class, 'id_troza');
    }

    public $incrementing = true;
    public $timestamps = false;
}