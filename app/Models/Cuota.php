<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuota
 *
 * @property $id
 * @property $pre_cuo
 * @property $ord_cuo
 * @property $fec_cuo
 * @property $val_cuo
 * @property $tot_abo_cuo
 * @property $sal_cuo
 * @property $num_cuo
 * @property $obs_cuo
 * @property $created_at
 * @property $updated_at
 *
 * @property Prestamo $prestamo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cuota extends Model
{
    
    static $rules = [
		'pre_cuo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pre_cuo','ord_cuo','fec_cuo','val_cuo','tot_abo_cuo','sal_cuo','num_cuo','obs_cuo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prestamo()
    {
        return $this->hasOne('App\Models\Prestamo', 'id', 'pre_cuo');
    }
    

}
