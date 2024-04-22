<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuota
 *
 * @property $id
 * @property $cli_cuo
 * @property $pre_cuo
 * @property $fec_cuo
 * @property $val_cuo
 * @property $tot_abo_cuo
 * @property $sal_cuo
 * @property $num_cuo
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Prestamo $prestamo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cuota extends Model
{
    
    static $rules = [
		'cli_cuo' => 'required',
		'pre_cuo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cli_cuo','pre_cuo','fec_cuo','val_cuo','tot_abo_cuo','sal_cuo','num_cuo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cli_cuo');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prestamo()
    {
        return $this->hasOne('App\Models\Prestamo', 'id', 'pre_cuo');
    }
    

}