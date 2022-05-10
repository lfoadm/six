<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\t_artigos;
use App\Models\Admin\t_conteudos;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $pagina = t_artigos::where('principal', 1)->first();
        $conteudos = t_conteudos::where('id_artigo', $pagina->id)->where('ativo', true)->orderBy('ordem', 'asc')->get();
        $menus = t_artigos::where('id_pai', 0)->where('ativo', true)->where('tipo', 'M')->orderBy('ordem', 'asc')->get();

        return view('/index', compact('pagina', 'conteudos', 'menus'));
    }

    public function buscapagina($link)
    {
        //dd($link);
        $pagina = t_artigos::where('link', $link)->first();
        $conteudos = t_conteudos::where('id_artigo', $pagina->id)->where('ativo', true)->orderBy('ordem', 'asc')->get();
        $menus = t_artigos::where('id_pai', 0)->where('ativo', true)->where('tipo', 'M')->orderBy('ordem', 'asc')->get();
        return view('/index', compact('pagina', 'conteudos', 'menus'));
    }

}
