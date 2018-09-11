<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Categories;
use App\Models\ProductImages;
use App\Models\Products;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

/**
 * @author Jonatas Rodrigues <jhonatas.fender@gmail.com>
 */
class ProductsController extends Controller
{
    /**
     * Inicializando a controller de categorias
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?: 15;
        $products = Products::paginate($limit);
        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request -
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        Products::create(
            [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->categories,
                'expiration_date' => $request->expiration_date,
                'description' => $request->description,
            ]
        );
        return redirect('/produts')
            ->with('produts_success', "Categoria cadastrado com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Products $products -
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Products $products -
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        $categories = Categories::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request -
     * @param \App\Models\Products $products -
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, Products $product)
    {
        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->categories;

            $product->expiration_date = Carbon::createFromFormat(
                'd/m/Y',
                $request->expiration_date
            )->format('Y-m-d');

            $product->description = $request->description;
            $product->save();

            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $key => $file) {
                    $path = storage_path(
                        $file->store('app/public/image')
                    );
                    $img = \Image::make($file)->save($path);

                    ProductImages::create(
                        [
                            'file' => $img->basename,
                            'products_id' => $product->id,
                        ]
                    );

                }
            }

            DB::commit();
            return redirect('/products')
                ->with(
                    'products_success',
                    "Categoria cadastrado com sucesso!"
                );
        } catch (\Exception $e) {
            DB::rollBack();
            $return = redirect()
                ->back()
                ->withInput()
                ->withErrors([$e->getMessage()]);

            return $return;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Products $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect('/products')->with(
            'products_success',
            'Produto deletado com sucesso!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Products  $product
     *
     * @return \Illuminate\Http\Response
     */
    public function distroyImage(ProductImages $img, Products $product)
    {
        $img->delete();
        return redirect("/products/$product->id/edit#list-image")
            ->with('products_success', 'Imagem deletado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Products $product -
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeletion(Products $product)
    {
        return view('admin.products.confirm', compact('product'));
    }
}
