<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 *
 * @property $id
 * @property $nom_cat
 * @property $created_at
 * @property $updated_at
 *
 * @property Gasto[] $gastos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    
    static $rules = [
		'nom_cat' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nom_cat'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gastos()
    {
        return $this->hasMany('App\Models\Gasto', 'cat_gas', 'id');
    }
    

}
