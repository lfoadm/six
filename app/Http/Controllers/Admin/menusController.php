<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\t_artigos;
use App\Models\Admin\t_conteudos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class menusController extends Controller
{
    //=================== LISTA DE MENUS ======================================//
    public function index()
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $menus = t_artigos::where('id_pai', 0)->where('tipo', 'M')->orderBy('ordem','asc')->get();
            return view('admin.panel.p-list-menus', compact('menus'));
        }
        else
        {
            return view('admin.panel.frm_login');
        }
    }

    //=================== INCLUIR MENUS ======================================//
    public function create() //frm_menus_insert()
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            return view('admin.panel.p-frm-menus_incluir', );
        }
        else
        {
            redirect()->route('formLogin');
        }
    }

    //=================== SALVA O MENU NA BASE DE DADOS ======================================//
    public function store(Request $request) //frm_usuarios_insert_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $menus = t_artigos::where('id_pai', 0)->count();
            $link = strtolower(preg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim($request->menu)), utf8_decode("ºª/áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ "), "oa-aaaaeeiooouuncAAAAEEIOOOUUNC-")));
            $dados = new t_artigos();
            $dados->menu = $request->menu;
            $dados->titulo = $request->titulo;
            $dados->title = $request->title;
            $dados->keywords = $request->keywords;
            $dados->descricao = $request->descricao;
            $dados->link = $link;
            $dados->ordem = $menus;
            $dados->save();
            return redirect()->route('menus.index')->with('success', 'Menu criado com sucesso!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }


    //----------------------------------------------------------------------------------------------
    // MENUS - ALTERAR
    public function edit($id) {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $dados = t_artigos::find($id);
            return view('admin.panel.p-frm-menus_alterar', compact('dados'));
        }
        else
        {
            redirect()->route('formLogin');
        }
    }

    //----------------------------------------------------------------------------------------------
    // MENUS - SALVA ALTERAR
    public function update(Request $request) {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $link = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim($request->menu)), utf8_decode("ºª/áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ "), "oa-aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
            $dados = t_artigos::find($request->id);
            $dados->menu = $request->menu;
            $dados->titulo = $request->titulo;
            $dados->title = $request->title;
            $dados->keywords = $request->keywords;
            $dados->descricao = $request->descricao;
            $dados->link = $link;
            $dados->save();
            return redirect()->route('menus.index')->with('success', 'Menu atualizado com sucesso!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }


    //=================== DESATIVAR MENU ======================================//
    public function frm_menus_desativar($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $dados = t_artigos::find($id);
            $dados->ativo = false;
            $dados->save();
            return redirect()->route('menus.index')->with('danger', 'Menu desativado!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== ATIVAR MENU ======================================//
    public function frm_menus_ativar($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $dados = t_artigos::find($id);
            $dados->ativo = true;
            $dados->save();
            return redirect()->route('menus.index')->with('success', 'Menu ativado!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== TORNAR MENU PRINCIPAL======================================//
    public function frm_menus_principal_salva($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $menus = t_artigos::where('id_pai', 0)->get();
            foreach ($menus as $menu)
            {
                $dados = t_artigos::find($menu->id);
                $dados->principal = false;
                $dados->save();
            }

            $dados = t_artigos::find($id);
            $dados->principal = true;
            $dados->save();
            return redirect()->route('menus.index')->with('info', 'Menu salvo como página principal!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== ORDENAR MENU ======================================//
    public function frm_menus_ordenar_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $menus = t_artigos::where('id_pai', 0)->orderBy('ordem','asc')->get();
            $itemID = $request->itemID;
            $itemIndex = $request->itemIndex;

            foreach($menus as $item)
            {
                return t_artigos::where('id', '=', $itemID)->update(array('ordem' => $itemIndex));
            }
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //----------------------------------------------------------------------------------------------
    // MENUS - EXCLUIR
    public function destroy($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $dados = t_artigos::find($id);
            return view('admin.panel.p-frm-menus_excluir', compact('dados'));
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //----------------------------------------------------------------------------------------------
    // MENUS - SALVA EXCLUSAO
    public function destroy_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            t_artigos::destroy($request->id);
            return redirect()->route('menus.index')->with('danger', 'Menu apagado!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== ADMINISTRAÇÃO =====================================//
    //=================== CONTEUDOS ========================================//
    //=================== DOS MENUS =======================================//

    //=================== LISTA DE CONTEUDOS DOS MENUS ======================================//
    public function indexConteudos($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $menu = t_artigos::find($id);
            $conteudos = t_conteudos::where('id_artigo', $menu->id)->orderBy('ordem','asc')->get();
            return view('admin.panel.p-list-menus-conteudos', compact('menu', 'conteudos'));
        }
        else
        {
            return view('admin.panel.frm_login');
        }
    }


    //=================== INCLUIR CONTEUDOS NOS MENUS ======================================//
    public function createConteudos($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $menu = t_artigos::find($id);
            return view('admin.panel.p-frm-menus-conteudos_incluir', compact('id', 'menu'));
        }
        else
        {
            redirect()->route('formLogin');
        }
    }


    //=================== SALVA O CONTEUDO DO MENU NA BASE DE DADOS ======================================//
    public function storeConteudos(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $ordem = t_conteudos::where('id_artigo', $request->id_artigo)->count();
            $dados = new t_conteudos;
            $dados->id_artigo = $request->id_artigo;
            $dados->nome = $request->nome;
            $dados->conteudo = $request->conteudo;
            $dados->ordem = $ordem;
            $dados->save();
            return redirect()->route('menus.conteudos.index', $request->id_artigo)->with('success', 'Conteúdo criado com sucesso!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== ORDENAR CONTEÚDOS DO MENU ======================================//
    /* public function frm_menus_conteudos_ordenar_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao002'))
        {
            $conteudos = t_conteudos::where('id_artigos', $request->id_artigo)->orderBy('ordem','asc')->get();
            $itemID = $request->itemID;
            $itemIndex = $request->itemIndex;
            $itemMenu = $request->itemMenu;
            foreach($conteudos as $item)
            {
                return t_artigos::where('id', '=', $itemID)->update(array('ordem' => $itemIndex));
            }
        }
        else
        {
            return redirect()->route('formLogin');
        }
    } */

}
