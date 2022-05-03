@extends('layouts.paneladmin')
    @section('paneladmin')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Excluir o menu: <strong>{{ $dados->titulo }}</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
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
                                        <form action="{{ route('menus.delete') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="menu">Título do Menu</label><br>
                                                    <span style="font-style:italic">{{ $dados->menu }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="titulo">Título da Página</label><br>
                                                    <span style="font-style:italic">{{ $dados->titulo }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="title">Title</label><br>
                                                    <span style="font-style:italic">{{ $dados->title }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="keywords">Palavras Chave</label><br>
                                                    <span style="font-style:italic">{{ $dados->keywords }}</span>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="descricao">Descrição</label><br>
                                                    <span style="font-style:italic">{{ $dados->descricao }}</span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $dados->id }}">
                                            <a href="{{ route('menus.index') }}" class="btn bg-gradient-dark btn-dark">Cancelar</a>
                                            <button type="submit" class="btn bg-gradient-danger btn-danger">Apagar</button>
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
