<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredRequest;
use App\Models\Registered;
use Illuminate\Http\Request;

class RegisteredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?: 15;
        $registered = Registered::paginate($limit);
        return view('admin.registered.list', compact('registered'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.registered.create', compact('registered'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\RegisteredRequest $request -
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RegisteredRequest $request)
    {
        Registered::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
            ]
        );
        return redirect('/registered')
            ->with('registered_success', "Usuário cadastrado com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Registered $registered -
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Registered $registered)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Registered $registered -
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Registered $registered)
    {
        return view('admin.registered.edit', compact('registered'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\RegisteredRequest $request    -
     * @param \App\Models\Registered               $registered -
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RegisteredRequest $request, Registered $registered)
    {
        $registered->name = $request->name;
        $registered->email = $request->email;
        $registered->address = $request->address;
        $registered->save();

        return redirect('/registered')
            ->with(
                'registered_success',
                "Usuário cadastrado com sucesso!"
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Registered $registered -
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registered $registered)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Registered $registered -
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeletion(Registered $registered)
    {
        return view('admin.registered.confirm', compact('registered'));
    }
}
