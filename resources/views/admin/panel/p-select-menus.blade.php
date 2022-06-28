@extends('layouts.paneladminselectmenu')
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="col-sm-12">
                            @include('admin.includes.alerts.alert')
                            @if($menus->count() > 0)
                                <ul id="menu">
                                    @foreach ($menus as $item)
                                        <li id="{{ $item->id }}" class="ui-state-default">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td style="width:100%">{{ $item->menu }}</td>
                                                        <td>
                                                            <a href="{{ route('submenus.index',$item->id) }}" type="button" style="width:200%; float: right" class="btn mb-1 btn-primary">Sub-menus</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p style="font-style: italic">Nenhum item cadastrado</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
