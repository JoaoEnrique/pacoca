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
        <h1 style="text-align: center;">500: Erro Interno no Servidor</h1>
        {{-- <img src="https://crud-odontologia.000webhostapp.com/img/server" class="img-page-not-found" style="height: 300px"> --}}
        <img src="https://crud-odontologia.000webhostapp.com/img/server"  style="height: 400px!important" class="img-page-not-found" srcset="">
    </div>

    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
