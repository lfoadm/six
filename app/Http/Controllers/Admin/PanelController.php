<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class panelController extends Controller
{
    //=================== Entrar no painel - login ======================================//
    public function login()
    {
        Session::put('lg_logado', false);
        if(!Session()->has('lg_tentativas')) { Session::put('lg_tentativas', 0); }
        $tentativas = Session::get('lg_tentativas');
        $tentativas++;
        //dd($tentativas);
        Session::put('lg_tentativas', $tentativas);
        return view('admin.panel.frm_login');
    }

    //=================== Consulta e efetua o login ======================================//
    public function efetlogin(Request $request)
    {
        $dados = DB::table('t_usuarios')->where('usuario', $request->usuario)->first();
        if(empty($dados))
        {
            return redirect()->route('admin.login');
        }
        else
        {
            if(Hash::check($request->senha, $dados->senha) && $dados->ativo)
            {
                Session::put('lg_id', $dados->id);
                Session::put('lg_logado', true);
                Session::put('lg_usuario', $dados->usuario);
                Session::put('lg_ativo', $dados->ativo);
                Session::put('lg_nome', $dados->nome);
                Session::put('lg_nick', $dados->nick);
                Session::put('lg_foto', $dados->foto);
                Session::put('lg_nome_foto', $dados->nome_foto);
                Session::put('lg_permissao001', $dados->permissao001);
                Session::put('lg_permissao002', $dados->permissao002);
                Session::put('lg_permissao003', $dados->permissao003);
                Session::put('lg_permissao004', $dados->permissao004);
                Session::put('lg_permissao005', $dados->permissao005);
                Session::put('lg_permissao006', $dados->permissao006);
                return redirect()->route('admin.home');
            }
            else
            {
                return redirect()->route('admin.login');
            }
        }
    }

    //=================== PAGINA INICIAL ======================================//
    public function homeadmin()
    {
        if(!Session::get('lg_logado'))
        {
            return redirect('/paneladmin');
        }
        else
        {
            return view('admin.panel.homeadmin');
        }
    }
}
