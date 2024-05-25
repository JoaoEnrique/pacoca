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
@section('title', 'Paçoca')

@section('content')
<div class="container-login">
    <div class="row row-login" style="height: 100%">
        <div class="col col-img-login">
          <img class="img-logo-login" src="../img/pacoca.png" height="400">
        </div>
        <div class="col col-form-login">

          <form class="form-login" method="POST" action="{{ route('login') }}">

            {{-- MENSAGEM DE CONTA CRIADA --}}
            @if(session()->has('conta-create-success'))
                <div class="alert alert-success alert-dismissible alert-account-create fade show" role="alert">
                    <strong>Conta Criada!</strong> Entre com seu email e senha.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- MENSAGEM DE CONTA NÃO CRIADA --}}
            @if(session()->has('conta-create-danger'))
                <div class="alert alert-danger alert-dismissible alert-account-create fade show" role="alert">
                    <strong>Não foi possivel criar conta!</strong> Tente novamente mais tarde.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <h2 class="titulo-login">login</h2>
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label> --}}

                    <div class="col">
                        <input placeholder="Email" id="email" type="email" class="input-login form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Senha --}}
                <div class="form-group">
                    {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label> --}}

                    <div class="col" style="position: relative">
                        <input placeholder="Senha" id="password" type="password" class="input-login form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" autocomplete="current-password">
                        {{-- IMAGEM DE VER SENHA --}}
                        <img class="view-password" id="view-password" src="{{asset('img/eye.svg')}}" onclick="showPassword()" srcset="">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert" style="display: block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <div class="col link-criar-conta">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Esqueci minha senha') }}
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Manter logado --}}
                <div class="form-group">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Manter logado') }}
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col link-criar-conta">

                        {{-- Botao submit --}}
                        <button type="submit" class="btn btn-login">
                            {{ __('login') }}
                        </button>

                        {{-- Link pra criar conta --}}
                        <a class="link-criar-conta" href="{{route('register')}}">Não tem uma conta? Cadastre-se</a>
                    </div>
                </div>


            </form>

            <script>
                //BOTÃO PARA MOSTRAR SENHA
                function showPassword() {//Botao de olho para mostrar e esconder a senha (pagina entrar)
                    var senha = document.querySelector("#password");
                    var imgShow = document.querySelector("#view-password");
                    if (senha.type === "password") {
                    senha.type = "text";
                    imgShow.src = "../img/eye-off.svg"
                    } else {
                    senha.type = "password";
                    imgShow.src = "../img/eye.svg"
                    }
                }
            </script>
        </div>
    </div>
  </div>
@endsection
