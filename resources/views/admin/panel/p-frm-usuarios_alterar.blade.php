@extends('layouts.paneladmin')
    @section('paneladmin')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Atualização de cadastro de usuário</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
                                <li class="breadcrumb-item active">Alteração</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        @include('admin.includes.alerts.alert')
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form action="{{ route('usuarios.update') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control" name="nome" required value="{{ $dados->nome }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="nick">Nickname</label>
                                                    <input type="text" class="form-control" name="nick" required value="{{ $dados->nick }}">
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="funcao">Função</label>
                                                    <input type="text" class="form-control" name="funcao" required value="{{ $dados->funcao }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="celular">Celular</label>
                                                    <input type="text" class="form-control" name="celular"  value="{{ $dados->celular }}" data-inputmask="'mask': ['(99) 99999-9999']" data-mask="(__) _____-____" inputmode="text">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email">E-mail</label>
                                                    <input type="email" class="form-control" name="email" required value="{{ $dados->email }}">
                                                </div>
                                                <input type="hidden" name="id" value="{{ $dados->id }}">
                                            </div>
                                            <a href="{{ route('usuarios.index') }}" class="btn bg-gradient-dark btn-dark">Cancelar</a>
                                            <button type="submit" class="btn bg-gradient-info btn-info">Atualizar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
