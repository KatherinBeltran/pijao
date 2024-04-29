<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cobradore
 *
 * @property $id
 * @property $nom_cob
 * @property $num_ced_cob
 * @property $num_cel_cob
 * @property $dir_cob
 * @property $bar_cob
 * @property $zon_cob
 * @property $created_at
 * @property $updated_at
 *
 * @property Barrio $barrio
 * @property Zona $zona
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cobradore extends Model
{
    
    static $rules = [
		'nom_cob' => 'required',
		'num_ced_cob' => 'required',
		'num_cel_cob' => 'required',
		'dir_cob' => 'required',
		'bar_cob' => 'required',
		'zon_cob' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nom_cob','num_ced_cob','num_cel_cob','dir_cob','bar_cob','zon_cob'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barrio()
    {
        return $this->hasOne('App\Models\Barrio', 'id', 'bar_cob');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zona()
    {
        return $this->hasOne('App\Models\Zona', 'id', 'zon_cob');
    }
    

}
