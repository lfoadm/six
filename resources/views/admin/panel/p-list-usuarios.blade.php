@extends('layouts.paneladmin')
    @section('paneladmin')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Usuários</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Usuários</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables-wrapper container-fluid dt_bootstrap4">
                                <a href="{{-- route('usuarios.create') --}}" type="button" class="btn mb-1 btn-success"><i class="fas fa-plus"></i> Usuário</a>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover" role="grid">
                                            <thead>
                                                <tr role="row">
                                                    <th>Código</th>
                                                    <th>Nome</th>
                                                    <th>E-mail</th>
                                                    <th>Status</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dados as $dado)
                                                    <tr data-widget="expandable-table" aria-expanded="false" role="row" class="odd">
                                                        <td style="width: 1%">{{ $dado->id }}</td>
                                                        <td style="width: 25%">{{ $dado->nome }}</td>
                                                        <td style="width: 20%">{{ $dado->email }}</td>
                                                        <td class="text-center" style="width: 10%">
                                                            @if( $dado->ativo === 1)
                                                                <span class="badge bg-success">Ativo</span>
                                                            @else
                                                                <span class="badge bg-danger">Inativo</span>
                                                            @endif
                                                        </td>
                                                        <td style="width: 10%">
                                                            <a href="{{-- route('usuarios.edit',['id'=>$dado->id]) --}}"><i class="fas fa-edit" style="color: black; margin-right:10px"></i></a>
                                                            <a href="{{-- route('usuarios.permissoes.show',['id'=>$dado->id]) --}}"><i class="fas fa-user-lock" style="color: black; margin-right:10px"></i></a>
                                                            <a href="{{-- route('usuarios.show',['id'=>$dado->id]) --}}"><i class="fas fa-trash-alt" style="color:brown; margin-right:10px"></i></a>
                                                            @if($dado->ativo)
                                                                <a href="/paneladmin/p-usuarios-desativar/{{ $dado->id }}"><i class="fas fa-user-slash" style="color:black; margin-right:10px"></i></a>
                                                            @else
                                                                <a href="/paneladmin/p-usuarios-ativar/{{ $dado->id }}"><i class="fas fa-user-check" style="color: black; margin-right:10px"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div>
                                            {{$dados->links()}}
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
