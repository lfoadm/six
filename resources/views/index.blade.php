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
                <div class="col-md-12">
                    @foreach ($conteudos as $conteudo)
                        <p>@php echo $conteudo->conteudo @endphp</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
