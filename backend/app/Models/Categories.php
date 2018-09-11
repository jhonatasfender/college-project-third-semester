<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

/**
 * Classe mapeada do banco
 * resposavel por trazer as categorias
 * cadastradas
 *
 * @author Jonatas Rodrigues <jhonatas.fender@gmail.com>
 */
class Categories extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon_image',
    ];

    /**
     * Relação com os produtos relacionado a essa categoria
     *
     * @return \App\Models\Products
     */
    public function products()
    {
        return $this->hasOne(Products::class);
    }
}
