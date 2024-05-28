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
@section('title', 'Paçoca - Tempo execido')

@include('layouts/menu')
@section('content')
    <div class="container container-404">
        <h1 style="text-align: center;">504: Tempo execido</h1>
        <img src="{{asset('img/server.png')}}"  style="height: 400px!important" class="img-page-not-found" srcset="">
    </div>

    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
