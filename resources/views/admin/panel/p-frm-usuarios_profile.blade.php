@extends('layouts.paneladmin')
    @section('paneladmin')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Perfil do usuário</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Perfil de usuário</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row">
                        <div class="col-md-12">
                            @include('admin.includes.alerts.alert')
                        </div>
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if(Session::get('lg_foto'))
                                        <img src="{{ asset('/img/usuarios') }}/{{ Session::get('lg_nome_foto') }}" class="profile-user-img img-fluid img-circle" style="width: 100%">
                                    @else
                                        <img src="{{ asset('/img/usuarios/Default.jpg') }}" class="profile-user-img img-fluid img-circle" style="width: 100%">
                                    @endif
                                </div>
                                <h3 class="profile-username text-center">{{ $dados->nome }}</h3>
                                <p class="text-muted text-center">{{ $dados->funcao }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills" role="tablist">
                                    <li class="nav-item"><a class="active nav-link" href="#dados" data-toggle="tab">Meus dados</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#login" data-toggle="tab">Acesso</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#avatar" data-toggle="tab">Avatar</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="dados">
                                        <form action="{{ route('profile.salvaDados') }}" class="form-horizontal" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="nome" class="col-sm-2 col-form-label" style="text-align: right">Nome</label>
                                                <div class="col-sm-6">
                                                    <input type="text" required name="nome" id="nome" class="form-control" placeholder="Nome" value="{{ $dados->nome }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nick" class="col-sm-2 col-form-label" style="text-align: right">Nickname</label>
                                                <div class="col-sm-6">
                                                    <input type="text" required name="nick" id="nick" class="form-control" placeholder="nick" value="{{ $dados->nick }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="celular" class="col-sm-2 col-form-label" style="text-align: right">Celular</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="celular" id="celular" class="form-control" value="{{ $dados->celular }}" data-inputmask="'mask': ['(99) 99999-9999']" data-mask="(__) _____-____" inputmode="text">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label" style="text-align: right">E-mail</label>
                                                <div class="col-sm-6">
                                                    <input type="email" required name="email" id="email" class="form-control" placeholder="email" value="{{ $dados->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="login">
                                        <form action="{{ route('profile.salvaSenha') }}" class="form-horizontal" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="nmusuario" class="col-sm-2 col-form-label" style="text-align: right">Usuário</label>
                                                <div class="col-sm-6">
                                                    <input type="text" required name="nmusuario" id="nmusuario" class="form-control" placeholder="Nome" value="{{ $dados->usuario }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="passatual" class="col-sm-2 col-form-label" style="text-align: right">Senha atual</label>
                                                <div class="col-sm-6">
                                                    <input type="password" required name="passatual" id="passatual" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="passnova" class="col-sm-2 col-form-label" style="text-align: right">Senha nova</label>
                                                <div class="col-sm-6">
                                                    <input type="password" required name="passnova" id="passnova" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="avatar">
                                        {{-- <form action="#" class="form-horizontal" method="POST">
                                            @csrf

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                </div>
                                            </div>
                                        </form> --}}

                                        <div class="col-sm-12" style="text-align: center">
                                            <a href="{{ route('profile.profileFoto') }}" class="btn btn-success">Alterar foto de perfil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
