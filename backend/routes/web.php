<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

Route::get('/', 'Admin\HomeController@index')->name('home');
Route::get('/home', 'Admin\HomeController@index')->name('home');

/**
 * Crop imagem
 */
Route::get(
    'storage/{path}/{options}/{name}.{extension}',
    'Image\ImageController@show'
)
    ->where('path', '[a-z-/]+')
    ->where('options', '[a-z0-9-_,]+')
    ->where('name', '.+?')
    ->where('extension', 'jpe?g|gif|png|JPE?G|GIF|PNG');
/**
 * Fim Crop imagem
 */

/**
 * Iniciando usuarios
 */
Route::resource('user', 'Admin\UserController');
/**
 * Fim Iniciando usuarios
 */

/**
 * Iniciando Categorias
 */
Route::get(
    'categories/confirm/deletion/{category}',
    'Admin\CategoriesController@confirmDeletion'
)->name('categories.confirm');
Route::resource('categories', 'Admin\CategoriesController');
/**
 * Fim Iniciando Categorias
 */

/**
 * Iniciando Produtos
 */
Route::get(
    'products/confirm/deletion/{product}',
    'Admin\ProductsController@confirmDeletion'
)->name('products.confirm');
Route::get(
    'products/distroyImage/{img}/{product}',
    'Admin\ProductsController@distroyImage'
)->name('products.distroyImage');
Route::resource('products', 'Admin\ProductsController');
/**
 * Fim Iniciando Produtos
 */

/**
 * Iniciando Cadastrados
 */
Route::get(
    'registered/confirm/deletion/{registered}',
    'Admin\RegisteredController@confirmDeletion'
)->name('registered.confirm');
Route::resource('registered', 'Admin\RegisteredController');
/**
 * Fim Iniciando Cadastrados
 */
