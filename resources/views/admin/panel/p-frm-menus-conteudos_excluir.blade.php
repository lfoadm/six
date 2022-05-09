@extends('layouts.paneladminconteudos')
    @section('paneladmin')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Conteúdo</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('menus.conteudos.index', $menu->id ) }}">Conteúdo</a></li>
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
                                        <form action="{{ route('menus.conteudos.destroy') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="nome">Nome do Conteúdo</label><br>
                                                    <span style="font-style:italic;">{{ $dados->nome }}</span>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="conteudo">Conteúdo</label>
                                                    <?php echo $dados->conteudo ?>

                                                </div>
                                                <input type="hidden" name="id_artigo" value="{{ $menu->id }}">
                                                <input type="hidden" name="id_conteudo" value="{{ $dados->id }}">
                                            </div>
                                            <a href="{{ route('menus.conteudos.index', $menu->id) }}" class="btn bg-gradient-dark btn-dark">Cancelar</a>
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
