<?php

namespace App\Models;

use App\Models\Categories;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Jonatas Rodrigues <jhonatas.fender@gmail.com>
 */
class Products extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'expiration_date',
    ];

    protected $dates = ['expiration_date'];

    /**
     * Retorna dados das imagens dos produtos.
     *
     * @return \App\Models\ProductImages -
     */
    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    /**
     * Retorna dados das categorias relacionados a esse produtos.
     *
     * @return \App\Models\Categories -
     */
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
