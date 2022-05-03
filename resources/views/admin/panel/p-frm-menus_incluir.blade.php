@extends('layouts.paneladmin')
    @section('paneladmin')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Cadastro de menus</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
                                <li class="breadcrumb-item active">Inclusão</li>
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
                                        <form action="{{ route('menus.store') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="menu">Título do Menu</label>
                                                    <input type="text" class="form-control" name="menu" autofocus required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="titulo">Título da Página</label>
                                                    <input type="text" class="form-control" name="titulo" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="keywords">Palavras Chave</label>
                                                    <input type="text" class="form-control" name="keywords">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="descricao">Descrição</label>
                                                    <input type="text" class="form-control" name="descricao">
                                                </div>
                                            </div>
                                            <a href="{{ route('menus.index') }}" class="btn bg-gradient-dark btn-dark">Cancelar</a>
                                            <button type="submit" class="btn bg-gradient-success btn-success">Incluir</button>
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
