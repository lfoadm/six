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
                                <li class="breadcrumb-item active">Exclusão</li>
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
                                        <form action="{{ route('usuarios.destroy') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label style="font-weight: bolder" for="nome">Nome</label><br>
                                                    <span style="font-style:italic">{{ $dados->nome }}</span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label style="font-weight: bolder" for="nome">Nickname</label><br>
                                                    <span style="font-style:italic">{{ $dados->nick }}</span>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label style="font-weight: bolder" for="nome">Função</label><br>
                                                    <span style="font-style:italic">{{ $dados->funcao }}</span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label style="font-weight: bolder" for="nome">Celular</label><br>
                                                    <span style="font-style:italic">{{ $dados->celular }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="font-weight: bolder" for="nome">E-mail</label><br>
                                                    <span style="font-style:italic">{{ $dados->email }}</span>
                                                </div>
                                                <input type="hidden" name="id" value="{{ $dados->id }}">
                                            </div>
                                            <a href="{{ route('usuarios.index') }}" class="btn bg-gradient-dark btn-dark">Cancelar</a>
                                            <button type="submit" class="btn bg-gradient-danger btn-danger">Excluir</button>
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
