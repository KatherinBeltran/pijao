<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestamo
 *
 * @property $id
 * @property $nom_cli_pre
 * @property $num_ced_cli_pre
 * @property $num_cel_cli_pre
 * @property $dir_cli_pre
 * @property $bar_cli_pre
 * @property $fec_pre
 * @property $fec_pag_ant_pre
 * @property $pag_pre
 * @property $cuo_pre
 * @property $cap_pre
 * @property $int_pre
 * @property $tot_pre
 * @property $val_cuo_pre
 * @property $cuo_pag_pre
 * @property $val_pag_pre
 * @property $sig_cuo_pre
 * @property $cuo_pen_pre
 * @property $val_cuo_pen_pre
 * @property $est_pag_pre
 * @property $dia_mor_pre
 * @property $created_at
 * @property $updated_at
 *
 * @property Barrio $barrio
 * @property Cuota[] $cuotas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prestamo extends Model
{
    
    static $rules = [
		'nom_cli_pre' => 'required',
		'num_ced_cli_pre' => 'required',
		'num_cel_cli_pre' => 'required',
		'dir_cli_pre' => 'required',
		'bar_cli_pre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nom_cli_pre','num_ced_cli_pre','num_cel_cli_pre','dir_cli_pre','bar_cli_pre','fec_pre','fec_pag_ant_pre','pag_pre','cuo_pre','cap_pre','int_pre','tot_pre','val_cuo_pre','cuo_pag_pre','val_pag_pre','sig_cuo_pre','cuo_pen_pre','val_cuo_pen_pre','est_pag_pre','dia_mor_pre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barrio()
    {
        return $this->hasOne('App\Models\Barrio', 'id', 'bar_cli_pre');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cuotas()
    {
        return $this->hasMany('App\Models\Cuota', 'pre_cuo', 'id');
    } 

    protected static function boot()
    {
        parent::boot();

        static::created(function ($prestamo) {
            // Crear un nuevo registro en la tabla de cuotas si est_pag_pre es "Al día"
            if ($prestamo->est_pag_pre === 'Al día') {
                self::crearPrimerCuota($prestamo);
            }
        });

        static::updated(function ($prestamo) {
            // Crear un nuevo registro en la tabla de cuotas si est_pag_pre ha cambiado a "Al día"
            if ($prestamo->isDirty('est_pag_pre') && $prestamo->est_pag_pre === 'Al día') {
                self::crearPrimerCuota($prestamo);
            }
        });
    }

    protected static function crearPrimerCuota($prestamo)
    {
        // Verificar si ya existe una cuota para este préstamo
        $existeCuota = $prestamo->cuotas()->exists();
    
        if (!$existeCuota) {
            $cuota = new Cuota();
            $cuota->pre_cuo = $prestamo->id;
            $cuota->num_cuo = 1;
    
            // Establecer la fecha de la primera cuota según el tipo de pago
            $fechaActual = Carbon::now('America/Bogota');
            switch ($prestamo->pag_pre) {
                case 'Diario':
                    $cuota->fec_cuo = $fechaActual->addDay();
                    break;
                case 'Semanal':
                    $cuota->fec_cuo = $fechaActual->addWeek();
                    break;
                case 'Quincenal':
                    $cuota->fec_cuo = $fechaActual->addWeeks(2);
                    break;
                case 'Mensual':
                    $cuota->fec_cuo = $fechaActual->addMonth();
                    break;
                default:
                    $cuota->fec_cuo = $fechaActual->addDay(); // Valor predeterminado: diario
            }
    
            $cuota->save();
        }
    }

}