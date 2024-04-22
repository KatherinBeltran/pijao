<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestamo
 *
 * @property $id
 * @property $cli_pre
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
 * @property $sig_cou_pre
 * @property $cou_pen_pre
 * @property $val_cou_pen_pre
 * @property $est_pag_pre
 * @property $dia_mor_pre
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Cuota[] $cuotas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prestamo extends Model
{
    
    static $rules = [
		'cli_pre' => 'required',
		'int_pre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cli_pre','fec_pre','fec_pag_ant_pre','pag_pre','cuo_pre','cap_pre','int_pre','tot_pre','val_cuo_pre','cuo_pag_pre','val_pag_pre','sig_cou_pre','cou_pen_pre','val_cou_pen_pre','est_pag_pre','dia_mor_pre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cli_pre');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cuotas()
    {
        return $this->hasMany('App\Models\Cuota', 'pre_cuo', 'id');
    }
    

}