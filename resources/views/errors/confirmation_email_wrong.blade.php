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
        <div>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail. Verifique também sua caixa de spam') }}
                </div>
            @endif

        <h1 style="text-align: center"> {{'Clique no link abaixo para enviar um link de verificacao para seu email' }}</h1>
            <form method="POST" action="/verify-email-server">
                @csrf
                <button type="submit" class="btn-link" style="background: transparent; border: 0; color: blue">{{ __('clique aqui para enviar um outro email de verificação.') }}</button>
            </form>
        </div>
    </div>

    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
