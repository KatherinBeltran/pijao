<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    protected $table = 'capital';
    
    static $rules = [
        'res_cap' => 'required',
        'des_cap' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['res_cap', 'des_cap', 'gas_cap'];

    public function gasto()
    {
        return $this->hasOne('App\Models\Gasto', 'id', 'gas_cap');
    }
    
    public static function createFromGasto(Gasto $gasto)
    {
        if ($gasto->cat_gas != 1) {
            return null;
        }

        $latestCapital = self::latest()->first();
        
        if (!$latestCapital) {
            // Manejar el caso donde no hay un registro de capital existente
            return self::create([
                'des_cap' => $gasto->mon_gas,
                'res_cap' => -$gasto->mon_gas, // o algún valor inicial
                'gas_cap' => $gasto->id,
            ]);
        }
        
        return self::create([
            'des_cap' => $latestCapital->des_cap + $gasto->mon_gas,
            'res_cap' => $latestCapital->res_cap - $gasto->mon_gas,
            'gas_cap' => $gasto->id,
        ]);
    }
}