<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Perfil;
use App\Utils\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @author Jonatas Rodrigues <jhonatas.fender@gmail.com>
 */
class UserController extends Controller
{
    /**
     * Inicializando a controller de usuários
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Listagem dos users
     *
     * @param Request $request -
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?: 15;
        $user = User::paginate($limit);
        return view('admin.user.list', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|string|max:255',
                'email' => 'required|email|unique:user,deleted_at,null',
                'cpf' => 'required|min:11|unique:user,deleted_at,null',
                'perfil' => 'required',
                'password' => 'required|min:3|confirmed',
            ]
        );
        try {
            if ($request->foto) {
                $path = public_path(User::PATH_UPLOAD_USER);
                \File::isDirectory($path) or \File::makeDirectory($path, 0777, true, true);
                Helper::compressImage($request->foto, $path);
            }

            if ($request->data_nascimento) {
                if (Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d') >= date('Y-m-d')) {
                    throw new \Exception("A data de nascimento não pode ser maior do que a data atual");
                }
            }

            $user = User::create(
                [
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'cpf' => $request->cpf,
                    'foto' => $request->foto ? $request->foto->hashName() : "",
                    'data_nascimento' => $request->data_nascimento ? Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d') : null,
                    'password' => bcrypt($request->password),
                    'perfil_id' => $request->perfil ?? "",
                ]
            );

            return redirect('user')->with('user_success', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors([$e->getMessage()], 'user_error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->validate(
                [
                    'nome' => 'required|string',
                    'cpf' => 'required',
                ]
            );

            if ($request->foto) {
                $path = public_path(User::PATH_UPLOAD_USER);
                \File::isDirectory($path) or \File::makeDirectory($path, 0777, true, true);
                $user->foto = Helper::compressImage($request->foto, $path);
            }

            if ($request->nome) {
                $user->nome = $request->nome;
            }

            if ($request->cpf) {
                $user->cpf = $request->cpf;
            }

            if ($request->data_nascimento) {
                if (Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d') >= date('Y-m-d')) {
                    throw new \Exception("Data de nascimento inválida, escolha uma data menor do que a data atual");
                }
                $user->data_nascimento = Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d');
            }

            if ($request->perfil) {
                $user->perfil_id = $request->perfil;
            }
            $user->save();

            return redirect(
                $request->session()->previousUrl() . '#edit-profile'
            )->with('user_profile_success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect(
                $request->session()->previousUrl() . '#edit-profile'
            )->withInput()
                ->withErrors([$e->getMessage()], 'user_profile_error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        \DB::beginTransaction();
        try {
            $user->delete();
            \DB::commit();
            return redirect('/user')->with('user_success', 'Usuário deletado com sucesso!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()
                ->withErrors([$e->getMessage()], 'user_error');
        }
    }
}
