<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Barrio
 *
 * @property $id
 * @property $nom_bar
 * @property $zon_bar
 * @property $created_at
 * @property $updated_at
 *
 * @property Prestamo[] $prestamos
 * @property Zona $zona
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Barrio extends Model
{
    
    static $rules = [
		'nom_bar' => 'required',
		'zon_bar' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nom_bar','zon_bar'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany('App\Models\Prestamo', 'bar_cli_pre', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zona()
    {
        return $this->hasOne('App\Models\Zona', 'id', 'zon_bar');
    }
    

}
