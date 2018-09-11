<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file', 'products_id',
    ];

    /**
     * Relação com os produtos relacionado a essa imagens
     *
     * @return \App\Models\Products
     */
    public function products()
    {
        return $this->hasMany('\App\Models\Products');
    }
}
