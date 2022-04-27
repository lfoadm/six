<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\t_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class usuariosController extends Controller
{
    //=================== LISTA DE USUÁRIOS ======================================//
    public function index()
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao001'))
        {
            $dados = DB::table('t_usuarios')->where('t_usuarios.id', '!=', Session::get('lg_id'))->orderBy('nome', 'asc')->paginate(10);
            return view('admin.panel.p-list-usuarios', ['dados' => $dados]);
        }
        else
        {
            redirect()->route('formLogin');
        }
    }

    //=================== INCLUIR USUÁRIOS ======================================//
    public function create() //frm_usuarios_insert()
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao001'))
        {
            return view('admin.panel.p-frm-usuarios_incluir', );
        }
        else
        {
            redirect()->route('formLogin');
        }
    }

    //=================== SALVA O USUÁRIO NA BASE DE DADOS ======================================//
    public function store(Request $request) //frm_usuarios_insert_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao001'))
        {
            $dados = new t_usuarios();
            $dados->nome = $request->nome;
            $dados->usuario = $request->email;
            $dados->senha = Hash::make($request->email);
            $dados->nick = $request->nick;
            $dados->funcao = $request->funcao;
            $dados->celular = $request->celular;
            $dados->email = $request->email;
            $dados->ativo = true;
            $dados->save();
            return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');;
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }
}
