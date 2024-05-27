{{--
    "PRA QUE SERVE
    TANTO CÓDIGO
    SE A VIDA
    NÃO É PROGRAMADA
    E AS MELHORES COISAS
    NÃO TEM LÓGICA".
    Algúem (algum ano)
--}}

@extends('layouts.main')
@section('title', 'Paçoca - Página não encontrada')

@include('layouts/menu')
@section('content')
        <div class="container container-404">
            <h1 style="text-align: center;">404: Página não encontrada</h1>
            <img src="{{asset('img/page-not-found.jpg')}}" style="margin-top: -400px" class="img-page-not-found" srcset="">
        </div>

        {{-- MENU DE CELULAR --}}
        @include('layouts/menu_mobile')
@endsection
