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
}
