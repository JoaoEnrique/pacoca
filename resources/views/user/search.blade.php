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
        <form class="form-mobile" method="GET" action="/search" role="search" style="margin-bottom: 40px;">
            @csrf
            <input value="{{$_GET['search']}}" class="form-control me-2" type="search" name="search" placeholder="Pesquisar" aria-label="Search" required>
            <button class="btn btn-blue" type="submit">Pesquisar</button>
        </form>
        {{-- Caso não encontre nennhum resultado --}}
        @if($users == "[]")
            <h1>Nenhum resultado</h1>
        @else
            <h1 class="title-notification">Resultados</h1><br><br>

            {{-- Lista todos os resultados com a pesquisa --}}
            @foreach ($users as $user)
                @if(auth()->check())
                    @php
                        $user_controller = app(App\Http\Controllers\UserController::class);
                        $is_following = $user_controller->is_following($user->id);// Verifica se usuario logado está seguindo usuário da conta
                    @endphp
                @else
                    @php
                        $user_controller = app(App\Http\Controllers\UserController::class);
                        $is_following =false;// Verifica se usuario logado está seguindo usuário da conta
                    @endphp
                @endif

                <div class="row account-search">
                    {{-- Imagem da conta no post --}}
                    @php
                        if($user->img_account){
                            $img_notification = $user->img_account;
                        }else{
                            $img_notification = asset('img/img-account.png');
                        }
                    @endphp

                    <div class="col-1 img-list-chat img-account-search" style="background-image: url('{{$img_notification}}')!important">
                    </div>

                    <div class="col-6">
                        <h5>
                            <a class="name-search" href="/{{$user->user_name}}">{{$user->name}}</a>
                            {{-- IMAGEM DE VERIFICADO --}}
                            @if ($user->user_name == 'joao' || $user->user_name == 'pacoca')
                                <img class="img-verificado-comentario" src="{{asset('img/verificado.png')}}" alt="" srcset="">
                            @endif
                        </h5>
                        <p>{{"@". $user->user_name}}</p>
                    </div>
                    <div class="col" style="display: flex; justify-content: end; align-items: center;">
                        {{-- Seguir --}}
                        @if($is_following)
                            <a href="" class="btn btn-blue btn-sm follow-user follow-user-{{$user->id}}" data-user="{{$user->id}}" style="width: 100%; background: #979797!important;">
                                Deixar de Seguir
                            </a>
                        @else
                            <a href="" class="btn btn-blue btn-sm follow-user follow-user-{{$user->id}}" data-user="{{$user->id}}" style="width: 100%;">
                                Seguir
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
            
        @endif
    </div>
    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
