@extends('layouts.paneladminmenussortable')
    @section('paneladmin')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Menus</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Menus</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <a href="{{ route('menus.create') }}" style="margin-bottom: 20px" class="btn btn-success mb-1"><i class="fas fa-plus"></i></a>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="col-sm-12">
                            @include('admin.includes.alerts.alert')
                            @if($menus)
                            <ul id="menu">
                                @foreach ($menus as $item)
                                    <li id="{{ $item->id }}" @if (!$item->ativo) style="background-color: #300c05; color: #fff" @endif class="ui-state-default">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td style="width:100%; text-align:justify;">{{ $item->menu }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left;">
                                                        <a href="{{ route('menus.edit',$item->id) }}" type="button" class="btn mb-1 btn-primary">Alterar</a>
                                                        @if(!$item->principal)
                                                            <a href="{{ route('menus.destroy', $item->id) }}" type="button" class="btn mb-1 btn-danger">Excluir</a>
                                                        @endif
                                                        <a href="{{ route('menus.conteudos.index', $item->id) }}" type="button" class="btn mb-1 btn-dark">Conteúdos</a>
                                                        @if(!$item->principal)
                                                            <a href="{{ route('menus.principal', $item->id) }}" type="button" class="btn mb-1 btn-success">Tornar Principal</a>
                                                            @if($item->ativo)
                                                                <a href="{{ route('menus.desativar', $item->id) }}" type="button" class="btn mb-1 btn-danger">Desativar</a>
                                                            @else
                                                                <a href="{{ route('menus.ativar', $item->id) }}" type="button" class="btn mb-1 btn-success">Ativar</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </li>
                                @endforeach
                            </ul>
                                @else
                                <p>Nenhum item cadastrado</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
