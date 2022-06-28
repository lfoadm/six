<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\t_artigos;
use App\Models\Admin\t_conteudos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class submenusController extends Controller
{
    //=================== SELECIONAR MENU ======================================//
    public function select_menu()
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $menus = t_artigos::where('id_pai', 0)->where('tipo', 'M')->orderBy('ordem','asc')->get();
            return view('admin.panel.p-select-menus', compact('menus'));
        }
        else
        {
            return view('admin.panel.frm_login');
        }
    }

    //=================== LISTA DE SUBMENUS ======================================//
    public function index($id_menu)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $menu = t_artigos::where('id', $id_menu)->first();
            $submenus = t_artigos::where('id_pai', $id_menu)->where('tipo', 'S')->orderBy('ordem','asc')->get();
            return view('admin.panel.p-list-submenus', compact('menu', 'submenus'));
        }
        else
        {
            return view('admin.panel.frm_login');
        }
    }

    //=================== INCLUIR SUBMENUS ======================================//
    public function create($id_menu) //frm_submenus_insert()
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $menu = t_artigos::where('id', $id_menu)->first();
            //dd();
            return view('admin.panel.p-frm-submenus_incluir', compact('menu'));
        }
        else
        {
            redirect()->route('formLogin');
        }
    }

    //=================== SALVA O MENU NA BASE DE DADOS ======================================//
    public function store(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $menu = t_artigos::where('id_pai', $request->id_pai)->count();
            $link = strtolower(preg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim($request->menu)), utf8_decode("ºª/áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ "), "oa-aaaaeeiooouuncAAAAEEIOOOUUNC-")));
            $dados = new t_artigos();
            $dados->menu = $request->menu;
            $dados->titulo = $request->titulo;
            $dados->title = $request->title;
            $dados->keywords = $request->keywords;
            $dados->descricao = $request->descricao;
            $dados->link = $link;
            $dados->ordem = $menu;
            $dados->tipo = 'S';
            $dados->id_pai = $request->id_pai;
            $dados->id_menu = $request->id_menu;
            $dados->save();
            return redirect()->route('submenus.index', $request->id_pai)->with('success', 'Menu criado com sucesso!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }


    //----------------------------------------------------------------------------------------------
    // SUBMENUS - ALTERAR
    public function edit($id) {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
    // SUBMENUS - SALVA ALTERAR
    public function update(Request $request) {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
    public function frm_submenus_desativar($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
    public function frm_submenus_ativar($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
    public function frm_submenus_principal_salva($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
            $dados->ativo = true;
            $dados->save();
            return redirect()->route('menus.index')->with('info', 'Menu salvo como página principal!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== ORDENAR MENU ======================================//
    public function frm_submenus_ordenar_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
    // SUBMENUS - EXCLUIR
    public function destroy($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
    // SUBMENUS - SALVA EXCLUSAO
    public function destroy_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
    //=================== DOS SUBMENUS =======================================//

    //=================== LISTA DE CONTEUDOS DOS SUBMENUS ======================================//
    public function indexConteudos($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $menu = t_artigos::find($id);
            $conteudos = t_conteudos::where('id_artigo', $menu->id)->orderBy('ordem','asc')->get();
            return view('admin.panel.p-list-submenus-conteudos', compact('menu', 'conteudos'));
        }
        else
        {
            return view('admin.panel.frm_login');
        }
    }


    //=================== INCLUIR CONTEUDOS NOS SUBMENUS ======================================//
    public function createConteudos($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
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


    //=================== ALTERAR CONTEUDOS NOS SUBMENUS ======================================//
    public function editConteudos($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $dados = t_conteudos::find($id);
            $menu = t_artigos::find($dados->id_artigo);
            return view('admin.panel.p-frm-menus-conteudos_alterar', compact('dados', 'menu'));
        }
        else
        {
            redirect()->route('formLogin');
        }
    }


    //=================== SALVA ALTERAÇÃO CONTEUDO DO MENU NA BASE DE DADOS ======================================//
    public function updateConteudos(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $dados = t_conteudos::find($request->id_conteudo);
            //dd($request->id_conteudo);
            $dados->nome = $request->nome;
            $dados->conteudo = $request->conteudo;
            $dados->save();
            return redirect()->route('menus.conteudos.index', $request->id_artigo)->with('success', 'Conteúdo alterado com sucesso!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== EXCLUIR CONTEUDOS NOS SUBMENUS ======================================//
    public function showConteudos($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $dados = t_conteudos::find($id);
            $menu = t_artigos::find($dados->id_artigo);
            return view('admin.panel.p-frm-menus-conteudos_excluir', compact('dados', 'menu'));
        }
        else
        {
            redirect()->route('formLogin');
        }
    }

    //=================== SALVA EXCLUSÃO CONTEUDO DO MENU NA BASE DE DADOS ======================================//
    public function destroyConteudos(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            t_conteudos::destroy($request->id_conteudo);
            $order = t_conteudos::where('id_artigo', $request->id_artigo)->count();
            $conteudos = t_conteudos::where('id_artigo', $request->id_artigo)->get();
            $neworder = 0;
            foreach($conteudos as $conteudo)
            {
                $dados = t_conteudos::find($conteudo->id);
                $dados->ordem = $neworder;
                $dados->save();
                $neworder++;
            }
            return redirect()->route('menus.conteudos.index', $request->id_artigo)->with('danger', 'Conteúdo excluído com sucesso!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== ATIVAR CONTEUDOS MENU ======================================//
    public function frm_submenus_conteudos_ativar($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $dados = t_conteudos::find($id);
            $id_artigo = $dados->id_artigo;
            $dados->ativo = true;
            $dados->save();
            return redirect()->route('menus.conteudos.index', $id_artigo)->with('success', 'Conteúdo ativado!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }


    //=================== DESATIVAR CONTEUDOS MENU ======================================//
    public function frm_submenus_conteudos_desativar($id)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $dados = t_conteudos::find($id);
            $id_artigo = $dados->id_artigo;
            $dados->ativo = false;
            $dados->save();
            return redirect()->route('menus.conteudos.index', $id_artigo)->with('danger', 'Conteúdo desativado!');
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }

    //=================== ORDENAR CONTEÚDOS DO MENU ======================================//
    public function frm_submenus_conteudos_ordenar_salva(Request $request)
    {
        if(Session::get('lg_logado') && Session::get('lg_permissao003'))
        {
            $conteudos = t_conteudos::where('id_artigo', $request->itemMenu)->orderBy('ordem','asc')->get();
            $itemID = $request->itemID;
            $itemIndex = $request->itemIndex;
            $itemMenu = $request->itemMenu;
            foreach($conteudos as $item)
            {
                return t_conteudos::where('id', '=', $itemID)->where('id_artigo', '=', $itemMenu)->update(array('ordem' => $itemIndex));
            }
        }
        else
        {
            return redirect()->route('formLogin');
        }
    }
}
