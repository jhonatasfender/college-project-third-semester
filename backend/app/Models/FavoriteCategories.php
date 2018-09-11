<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe mapeada do banco
 * resposavel por trazer as categorias favoritas dos usuarios
 * cadastradas, esse model irá relacionar com user e com categoria
 *
 * @author Jonatas Rodrigues <jhonatas.fender@gmail.com>
 */
class FavoriteCategories extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_category', 'id_user',
    ];
}
