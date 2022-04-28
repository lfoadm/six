<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\t_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File as FacadesFile;

class profileController extends Controller
{
    //=================== perfil de usuários ======================================//
    public function frm_usuarios_profile()
    {
        if(Session::get('lg_logado'))
        {
            $dados = t_usuarios::find(Session::get('lg_id'));
            return view('admin.panel.p-frm-usuarios_profile', compact('dados'));
        }
        else
        {
            redirect()->route('formLogin');
        }
    }

    //=================== salva dados profile ======================================//
    public function frm_usuarios_profile_salva_dados(Request $request)
    {
        if(Session::get('lg_logado'))
        {
            $dados = t_usuarios::find(Session::get('lg_id'));
            $dados->nome = $request->nome;
            $dados->nick = $request->nick;
            $dados->celular = $request->celular;
            $dados->email = $request->email;
            $dados->save();
            return redirect()->route('usuarios.profile')->with('success', 'Dados atualizados com sucesso!');
        }
        else { return redirect()->route('formLogin'); }
    }


    //=================== salva senha profile ======================================//
    public function frm_usuarios_profile_salva_senha(Request $request)
    {
        if(Session::get('lg_logado'))
        {
            $dados = t_usuarios::find(Session::get('lg_id'));
            if(Hash::check($request->passatual, $dados->senha))
            {
                $dados->usuario = $request->nmusuario;
                $dados->senha = Hash::make($request->passnova);
                $dados->save();
                return redirect()->route('usuarios.profile')->with('info', 'Dados de acesso atualizados!');
            }
        }
        else { return redirect()->route('formLogin'); }
    }

    //=================== usuário foto profile ======================================//
    public function frm_usuarios_profile_profile_foto()
    {
        if(Session::get('lg_logado'))
        {
            $dados = t_usuarios::find(Session::get('lg_id'));
            return view('admin.panel.p-frm-usuarios_crop_image_upload', compact('dados'));
        }
        else { redirect()->route('formLogin'); }
    }

    //=================== salva foto profile ======================================//
    public function frm_usuarios_profile_picture_salva(Request $request)
    {
        if(Session::get('lg_logado'))
        {
            $folderPath = public_path('img/usuarios/');
            //$id = $request->id;
            $image_parts = explode(";base64,", $request->image);
            //$image_type_aux = explode("img/usuarios/", $image_parts[0]);
            //$image_type = $image_type_aux[0];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.jpg';
            $imageFullPath = $folderPath.$imageName;
            file_put_contents($imageFullPath, $image_base64);

            $dados = t_usuarios::find(Session::get('lg_id'));
            $dados->nome_foto = $imageName;
            $dados->foto = true;
            $dados->save();
            Session::put('lg_foto', 1);
            Session::put('lg_nome_foto', $imageName);
            return true;
        }
        else { return redirect()->route('formLogin'); }
    }

    //=================== exclui foto profile ======================================//
    public function frm_usuarios_profile_picture_exclui()
    {
        if(Session::get('lg_logado'))
        {
            $dados = t_usuarios::find(Session::get('lg_id'));
            FacadesFile::delete('img/usuarios/'.$dados->nome_foto);
            $dados->nome_foto = null;
            $dados->foto = false;
            $dados->save();
            Session::put('lg_foto', 0);
            Session::put('lg_nome_foto', null);
            return redirect()->route('profile.profileFoto')->with('danger', 'Foto apagada!');
        }
        else { return redirect()->route('formLogin'); }
    }
}
