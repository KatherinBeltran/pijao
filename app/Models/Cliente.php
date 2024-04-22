<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $nom_cli
 * @property $num_ced_cli
 * @property $num_cel_cli
 * @property $dir_cli
 * @property $bar_cli
 * @property $created_at
 * @property $updated_at
 *
 * @property Cuota[] $cuotas
 * @property Prestamo[] $prestamos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    
    static $rules = [
		'nom_cli' => 'required',
		'num_ced_cli' => 'required',
		'num_cel_cli' => 'required',
		'dir_cli' => 'required',
		'bar_cli' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nom_cli','num_ced_cli','num_cel_cli','dir_cli','bar_cli'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cuotas()
    {
        return $this->hasMany('App\Models\Cuota', 'cli_cuo', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany('App\Models\Prestamo', 'cli_pre', 'id');
    }
    
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($cliente) {
            // Establecer el ID del préstamo como 1 más el código del cliente
            $id_prestamo = 1 . $cliente->id;
    
            $fechaHoraActual = now()->setTimezone('America/Bogota')->toDateTimeString();
    
            // Crear un nuevo registro en la tabla de préstamos
            $prestamo = new Prestamo();
            $prestamo->id = $id_prestamo;
            $prestamo->cli_pre = $cliente->id;
            $prestamo->fec_pre = $fechaHoraActual;
            $prestamo->int_pre = 20; // Interés
            $prestamo->save();
    
            // Crear un nuevo registro en la tabla de cuotas
            $cuota = new Cuota();
            $cuota->pre_cuo = $id_prestamo; // Asignar el ID del préstamo
            $cuota->cli_cuo = $cliente->id; // Asignar el ID del cliente
            $cuota->num_cuo = 1;
            $cuota->save();
        });
    } 
    
    
}