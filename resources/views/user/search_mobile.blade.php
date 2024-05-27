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
@section('title', 'Pesquisa')
@include('layouts/menu')

@section('content')
    <div class="container container-search" style="margin-top: 20px">
        {{-- Formulario de pesquisa --}}
        <form class="d-flex form-search" method="GET" action="/search" role="search" style="margin: 0;margin-bottom: 70px;">
            @csrf
            <input class="form-control me-2" type="search" name="search" placeholder="Pesquisar" aria-label="Search" required>
            <button class="btn btn-blue" type="submit">Pesquisar</button>
        </form>
        @php
            $user_controller = app(App\Http\Controllers\UserController::class);
            $pacoca = $user_controller->getUserByUserName('pacoca');
            $joao = $user_controller->getUserByUserName('joao');
        @endphp
        <div class="row account-search">
            {{-- imagem da conta pacoca --}}
            <div class="col-1 img-list-chat img-account-search" style="background-image: url('{{$pacoca->img_account}}')!important">
            </div>


            <div class="col-6">
                <h5>
                    <a class="name-search" href="/pacoca">{{$pacoca->name}}</a>
                    {{-- IMAGEM DE VERIFICADO --}}
                    <img class="img-verificado-comentario" src="{{asset('img/verificado.png')}}" alt="" srcset="">
                </h5>
                <p>{{"@" . $pacoca->user_name}}</p>
            </div>
            <div class="col">
                {{-- Seguir --}}
                @php
                    $is_following = $user_controller->is_following($pacoca->id);// Verifica se usuario logado está seguindo usuário da conta
                @endphp
                @if($is_following)
                    <a href="" class="btn btn-blue btn-sm follow-user follow-user-{{$joao->id}}" data-user="{{$pacoca->id}}" style="width: 100%; background: #979797!important;">
                        Deixar de Seguir
                    </a>
                @else
                    <a href="" class="btn btn-blue btn-sm follow-user follow-user-{{$joao->id}}" data-user="{{$pacoca->id}}" style="width: 100%;">
                        Seguir
                    </a>
                @endif
            </div>
        </div>

        <div class="row account-search">
            {{-- imagem da conta joao --}}
            <div class="col-1 img-list-chat img-account-search" style="background-image: url('{{$joao->img_account}}')!important">
            </div>
            <div class="col-6">
                <h5>
                    <a class="name-search"  href="/joao">{{$joao->name}}</a>
                    {{-- IMAGEM DE VERIFICADO --}}
                    <img class="img-verificado-comentario" src="{{asset('img/verificado.png')}}" alt="" srcset="">
                </h5>
                <p>{{"@" . $joao->user_name}}</p>
            </div>
            <div class="col">
                {{-- Seguir --}}
                @php
                    $is_following = $user_controller->is_following($joao->id);// Verifica se usuario logado está seguindo usuário da conta
                @endphp
                @if($is_following)
                    <a href="" class="btn btn-blue btn-sm follow-user follow-user-{{$joao->id}}" data-user="{{$joao->id}}" style="width: 100%; background: #979797!important;">
                        Deixar de Seguir
                    </a>
                @else
                    <a href="" class="btn btn-blue btn-sm follow-user follow-user-{{$joao->id}}" data-user="{{$joao->id}}" style="width: 100%;">
                        Seguir
                    </a>
                @endif
            </div>
        </div>
    </div>
    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
