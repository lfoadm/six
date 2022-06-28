<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\t_artigos;
use App\Models\Admin\t_conteudos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function index()
    {
        if(!Session()->has('lg_menu')){Session::put('lg_menu', 0);}
        $pagina = t_artigos::where('principal', 1)->first();
        $conteudos = t_conteudos::where('id_artigo', $pagina->id)->where('ativo', true)->orderBy('ordem', 'asc')->get();
        $menus = t_artigos::where('id_pai', 0)->where('ativo', true)->where('tipo', 'M')->orderBy('ordem', 'asc')->get();
        Session::put('lg_menu', $pagina->id);
        return view('/index', compact('pagina', 'conteudos', 'menus'));
    }

    public function buscapagina($link)
    {
        //dd($link);
        if(!Session()->has('lg_menu')){Session::put('lg_menu', 0);}
        $pagina = t_artigos::where('link', $link)->first();
        //dd($pagina);
        $conteudos = t_conteudos::where('id_artigo', $pagina->id)->where('ativo', true)->orderBy('ordem', 'asc')->get();
        //dd($conteudos);
        $menus = t_artigos::where('id_pai', 0)->where('ativo', true)->where('tipo', 'M')->orderBy('ordem', 'asc')->get();
        Session::put('lg_menu', $pagina->id);
        return view('/index', compact('pagina', 'conteudos', 'menus'));
    }

}
