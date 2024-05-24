{{--
    "PRA QUE SERVE
    TANTO CÓDIGO
    SE A VIDA
    NÃO É PROGRAMADA
    E AS MELHORES COISAS
    NÃO TEM LÓGICA".
    Algúem (algum ano)
--}}
@php
    $user_controller = app(App\Http\Controllers\UserController::class);
    $post_controller = app(App\Http\Controllers\PostsController::class);
@endphp
@extends('layouts.main')
@php
    $user = auth()->user();

@endphp
@section('title', 'Paçoca - Editar Conta')

@include('layouts/menu') {{-- Adiciona menu --}}

{{-- Conteudo --}}
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">{{-- TOKEN PARA O CURTIR FUNCIONAR --}}

    {{-- Informações da conta --}}
    <div class="container container-account" style="padding-bottom: 100px">
        {{-- Mudar imagem da conta --}}
        {{-- o  enctype="multipart/form-data" serve para salvar arquivos --}}
        <form class="col" action="/edit-image-account" method="post" enctype="multipart/form-data">
            @csrf

                <div class="container" style="display:flex; justify-content: center;">
                    <div class="row">
                        <div class="col" style="position: relative">
                            {{-- Imagem da conta --}}
                            @if($user->img_account)
                                <label for="img" class="label-img img-edit  @error('img') img-error @enderror" style="background-image: url('{{$user->img_account}}')">
                                    <img src="../img/photo.png" width="50%">
                                </label>
                                {{-- <img src="{{$user->img_account}}" class="img-conta" srcset=""> --}}
                            @else
                                <label for="img" class="label-img img-edit  @error('img') img-error @enderror" style="background-image: url('../img/img-account.png')">
                                    <img src="../img/photo.png"  width="50%">
                                </label>
                                {{-- <img src="../img/img-account.png" class="img-conta" srcset=""> --}}
                            @endif
                            <label for="img" style="cursor: pointer">
                                <div style="padding: 5; position: absolute; bottom: 5px; right: 15px; background: #fff; border-radius: 15px" class="">
                                    <img style="width: 25;" src="{{asset('img/edit.png')}}" alt="" srcset="">
                                </div>
                            </label>
                        </div>
                    </div>
            </div>

            <div class="col">
                <input type="file" class="d-none @error('img') is-invalid @enderror" name="img" id="img">

                    @error('img')
                        <span class="invalid-feedback" role="alert" style="text-align: center">
                            {{-- <strong>{{ $message }}</strong> --}}
                            <strong> Selecione uma imagem acima </strong>
                        </span>
                    @enderror
            </div>
            <div class="col" style="display:flex; justify-content: center;">
                <button class="btn btn-login" type="submit" style="width: 150px; margin-top: 5px">Salvar</button>
            </div>
        </form>




        <div class="row">
            <div class="col-8 col-name-user-edit">
                <div class="row row-filtro-account" style="margin-top: -35px; margin-bottom: 20px">
                    {{-- Icon img --}}
                    <div class="col col-filtro" @if(!isset($_GET['fillter'])) style="border-bottom-color: #000!important;" @endif>
                        <a href="/edit">
                            Informações
                        </a>
                    </div>

                    {{-- Icon all --}}
                    <div class="col col-filtro" @if(isset($_GET['fillter']) && $_GET['fillter'] == 'email') style="border-bottom-color: #000!important;" @endif>
                        <a href="/edit?fillter=email">
                            Email
                        </a>
                    </div>
                    {{-- Icon all --}}
                    <div class="col col-filtro" @if(isset($_GET['fillter']) && $_GET['fillter'] == 'senha') style="border-bottom-color: #000!important;" @endif>
                        <a href="/edit?fillter=senha">
                            Senha
                        </a>
                    </div>
                </div>
                @if(!isset($_GET['fillter']))
                    <form class="row" action="/edit-info" method="post">
                        @csrf
                        {{-- ID do usuario --}}
                            <input id="id_user" type="hidden" class="form-control" name="id_user" value="{{ $user->id }}" autocomplete="off" autofocus>

                        {{-- Nome --}}
                        <div class="col-md-6">
                            <label for="name" class="col-md-4 label-register text-md-right">{{ __('Nome') }}</label>

                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Nome de usuário --}}
                        <div class="col-md-6">
                            <label for="user_name" class="col-md-4 label-register text-md-right">{{ __('Nome de usuário') }}</label>

                            <div class="col">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ $user->user_name }}" autocomplete="off">

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        {{-- <div class="col-md-6">
                            <label for="email" class="col-md-4 label-register text-md-right">{{ __('Email') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- Telefone --}}
                        <div class="col-12">
                            <label for="phone" class="col-md-4 label-register text-md-right">{{ __('Telefone') }}</label>

                            <div class="col">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" autocomplete="tel">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Senha --}}
                        {{-- <div class="col-md-6">
                            <label for="password" class="col-md-4 label-register text-md-right">{{ __('Senha') }}</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- Confirmar Senha --}}
                        {{-- <div class="col-md-6">
                            <label for="password-confirm" class="col-md-4 label-register text-md-right @error('password_confirmation') is-invalid @enderror">{{ __('Confirmar Senha') }}</label>

                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- Site --}}
                        <div class="col-md-6">
                            <label for="site" class="col-md-4 label-register text-md-right">{{ __('Site') }}</label>

                            <div class="col">
                                <input id="site" type="link" class="form-control @error('site') is-invalid @enderror" name="site" value="{{ $user->site }}">

                                @error('site')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Biografia --}}
                        <div class="col-md-6">
                            <label for="biography" class="col-md-4 label-register text-md-right">{{ __('Biografia') }}</label>

                            <div class="col">
                                <input id="biography" type="text" class="form-control @error('biography') is-invalid @enderror" name="biography" value="{{ $user->biography }}">

                                @error('biography')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Sexo --}}
                        <div class="col-md-6">
                            <label for="sexo" class="col-md-4 label-register text-md-right">{{ __('Sexo') }}</label>

                            <div class="col">
                                <input id="sexo" type="text" class="form-control @error('sexo') is-invalid @enderror" name="sexo" value="{{ $user->sexo }}" autocomplete="off">

                                @error('sexo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Data de Nascimento --}}
                        <div class="col-md-6 mb-5">
                            <label for="birth_date" class="col-md-4 label-register text-md-right">{{ __('Data de nascimento') }}</label>

                            <div class="col">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ $user->birth_date }}">

                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Criar Conta --}}
                        <div class="form-group">
                            <div class="col link-criar-conta">
                                <button type="submit" class="btn btn-login">
                                    {{ __('Atualizar Conta') }}
                                </button>
                            </div>
                        </div>
                    </form>

                {{-- EDITAR EMAIL --}}
                @elseif(isset($_GET['fillter']) && $_GET['fillter'] == 'email')

                    <form class="row" action="/edit-email" id="form-edit-email" method="post">
                        @csrf
                        {{-- ID do usuario --}}
                        <input id="id_user" type="hidden" class="form-control" name="id_user" value="{{ $user->id }}" autocomplete="off" autofocus>

                        {{-- Email --}}
                        <div class="col-12">
                            <label for="email" class="col-md-4 label-register text-md-right">{{ __('Email') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- Criar Conta --}}
                        <div class="form-group mt-5">
                            <div class="col link-criar-conta">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-confirm-edit-email" class="btn btn-login">
                                    {{ __('Atualizar Email') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @elseif(isset($_GET['fillter']) && $_GET['fillter'] == 'senha')


                <form class="row" action="/edit-password" method="post">
                    @csrf
                    {{-- ID do usuario --}}
                    <input id="id_user" type="hidden" class="form-control" name="id_user" value="{{ $user->id }}" autocomplete="off" autofocus>
                        {{-- Senha --}}
                        <div class="col-12">
                            <label for="old_password" class="col-md-4 label-register text-md-right">{{ __('Senha atual') }}</label>

                            <div class="col">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autocomplete="off">

                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col mt-3">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Esqueci minha senha') }}
                                    </a>
                                @endif
                            </div>
                        </div>


                        {{-- Senha --}}
                        <div class="col-md-6">
                            <label for="password" class="col-md-4 label-register text-md-right">{{ __('Nova senha') }}</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirmar Senha --}}
                        <div class="col-md-6">
                            <label for="password-confirm" class="col-md-4 label-register text-md-right @error('password_confirmation') is-invalid @enderror">{{ __('Confirmar Senha') }}</label>

                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- Criar Conta --}}
                        <div class="form-group mt-5">
                            <div class="col link-criar-conta">
                                <button type="submit" class="btn btn-login">
                                    {{ __('Atualizar Senha') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
