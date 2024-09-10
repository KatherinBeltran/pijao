<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gasto
 *
 * @property $id
 * @property $fec_gas
 * @property $mon_gas
 * @property $cat_gas
 * @property $created_at
 * @property $updated_at
 *
 * @property Capital[] $capitals
 * @property Categoria $categoria
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Gasto extends Model
{
    
    static $rules = [
		'fec_gas' => 'required',
		'mon_gas' => 'required',
		'cat_gas' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fec_gas','mon_gas','cat_gas'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function capitals()
    {
        return $this->hasMany('App\Models\Capital', 'gas_cap', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'cat_gas');
    }
    

}
