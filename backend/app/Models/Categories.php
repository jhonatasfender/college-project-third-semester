<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;

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
        // return $this->hasMany(Products::class);
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'favorite_categories', 'id_user', 'id_category')
            ->withTimestamps();
    }
}
