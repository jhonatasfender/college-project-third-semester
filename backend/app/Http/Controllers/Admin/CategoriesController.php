<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
        $categories = Categories::paginate($limit);
        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request -
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $this->validCategories($request);

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = storage_path(
                    $image->store('app/public/image')
                );

                $img = \Image::make($image)->save($path);

                Categories::create(
                    [
                        'name' => $request->name,
                        'icon_image' => $img->basename,
                    ]
                );
            }

            return redirect('/categories')
                ->with(
                    'categories_success',
                    "Categoria cadastrado com sucesso!"
                );

        } catch (\Exception $e) {
            $return = redirect()
                ->back()
                ->withInput()
                ->withErrors(
                    [
                        'Falha ao cadastrar a Categoria',
                        $e->getMessage(),
                    ],
                    'categories_update_error'
                );
            return $return;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Categories $category -
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Categories $category -
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request -
     *
     * @return void
     */
    protected function validCategories(Request &$request)
    {
        $request->validate(
            [
                'name' => 'required',
                'file' => 'required | mimes:jpeg,jpg,png | max:1000',
            ],
            [
                'name.required' => 'teste :attribute field is required.',
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request  -
     * @param Categories               $category -
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $category)
    {
        try {
            $this->validCategories($request);

            $category->name = $request->name;

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = storage_path(
                    $image->store('app/public/image')
                );

                $img = \Image::make($image)->save($path);
                $category->icon_image = $img->basename;
            }

            $category->save();

            return redirect('/categories')
                ->with(
                    'categories_success',
                    "Categoria cadastrado com sucesso!"
                );
        } catch (\Exception $e) {
            $return = redirect()
                ->back()
                ->withInput()
                ->withErrors(
                    [
                        'Falha ao cadastrar a Categoria',
                        $e->getMessage(),
                    ],
                    'categories_update_error'
                );
            return $return;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Categories $category -
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect('/categories')->with(
            'categories_success',
            'Usuário deletado com sucesso!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Categories $category -
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeletion(Categories $category)
    {
        return view('admin.categories.confirm', compact('category'));
    }
}
