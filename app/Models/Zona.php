<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Zona
 *
 * @property $id
 * @property $nom_zon
 * @property $created_at
 * @property $updated_at
 *
 * @property Barrio[] $barrios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Zona extends Model
{
    
    static $rules = [
		'nom_zon' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nom_zon'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barrios()
    {
        return $this->hasMany('App\Models\Barrio', 'zon_bar', 'id');
    }
    

}