@extends('layouts.app')

@section('page')
    <section class="breadcrumbs">
        <div class="container">
            <div class="row">
                <h2 style="margin-top: 30px">{{ $pagina->titulo }}</h2>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container newsletter">
            <div class="row">
                @foreach ($conteudos as $conteudo)
                <div class="col-md-12">
                    <p>@php echo $conteudo->conteudo @endphp</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
