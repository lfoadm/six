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
                            <li class="breadcrumb-item active">Permissões</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Permissões para usuário: <strong style="color: blue">{{ $dados->nome }}</strong></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('admin.includes.alerts.alert')
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('usuarios.permissoes.store') }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-12 col-sm-12">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">Permissões</span>
                                                        <div class="form-group">
                                                            <div
                                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox"
                                                                    @if ($dados->permissao001) checked @endif
                                                                    class="custom-control-input" id="permissao001"
                                                                    name="permissao001">
                                                                <label class="custom-control-label"
                                                                    for="permissao001">Cadastro de Usuários</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox"
                                                                    @if ($dados->permissao002) checked @endif
                                                                    class="custom-control-input" id="permissao002"
                                                                    name="permissao002">
                                                                <label class="custom-control-label"
                                                                    for="permissao002">Cadastro de Menus</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox"
                                                                    @if ($dados->permissao003) checked @endif
                                                                    class="custom-control-input" id="permissao003"
                                                                    name="permissao003">
                                                                <label class="custom-control-label"
                                                                    for="permissao003">Cadastro de Submenus</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox"
                                                                    @if ($dados->permissao004) checked @endif
                                                                    class="custom-control-input" id="permissao004"
                                                                    name="permissao004">
                                                                <label class="custom-control-label"
                                                                    for="permissao004">Cadastro de Artigos</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox"
                                                                    @if ($dados->permissao005) checked @endif
                                                                    class="custom-control-input" id="permissao005"
                                                                    name="permissao005">
                                                                <label class="custom-control-label"
                                                                    for="permissao005">Configurações de sistema</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox"
                                                                    @if ($dados->permissao006) checked @endif
                                                                    class="custom-control-input" id="permissao006"
                                                                    name="permissao006">
                                                                <label class="custom-control-label"
                                                                    for="permissao006">Outros</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $dados->id }}">
                                        </div>
                                        <a href="{{ route('usuarios.index') }}"
                                            class="btn bg-gradient-dark btn-dark">Cancelar</a>
                                        <button type="submit" class="btn bg-gradient-primary btn-primary">Atualizar</button>
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

