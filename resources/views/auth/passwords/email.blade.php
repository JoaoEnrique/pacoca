{{-- @extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Redefinir senha') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-blue">
                                    {{ __('Enviar link de redefinição de senha') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


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
            <img class="img-logo-login" src="https://crud-odontologia.000webhostapp.com/img/pacoca.png" height="400">
            </div>
            <div class="col col-form-login">



                {{-- Spinner carregamento --}}
                <div class="row show-spinner mt-5" style="display: none">
                    <div class="col" style="justify-content: center; display: flex;">
                        <div style="border-width: 5px!important; height: 50px;width: 50px; color: #5bb4ff" class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <form class="form-login" id="form-open-loading" style="margin-top: -50px;" method="POST" action="{{ route('password-email') }}">


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }} Se não recebeu, verifique sua caixa de spam ou solicite outro link
                        </div>
                    @endif

                    @if (session('sucess'))
                        <div class="alert alert-success" role="alert">
                            {{ session('sucess') }} Se não recebeu, verifique sua caixa de spam ou solicite outro link
                        </div>
                    @endif


                    @if (session('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('danger') }}
                        </div>
                    @endif


                    <h2 class="titulo-login">{{ __('Redefinir Senha') }}</h2>
                    @csrf

                    {{-- Email --}}
                    <div class="form-group">
                        <div class="col">
                            <input placeholder="Email" id="email" type="email" class="input-login form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{-- Submit --}}
                        <div class="col mt-5 " style="margin-bottom: 80px!important">
                            <button type="submit" class="btn btn-blue" style="width: 100%">
                                {{ __('Enviar link de redefinição de senha') }}
                            </button>
                        </div>

                        <div class="form-group mb-5" style="margin-bottom: 60px!important;">
                            <div class="col link-criar-conta mt-5">
                                {{-- Link pra criar conta --}}
                                <a class="mt-5 link-criar-conta" href="{{route('login')}}">Já tem conta? Faça Login</a>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <div class="col link-criar-conta mt-5">
                                {{-- Link pra criar conta --}}
                                <a class="mt-5 link-criar-conta" href="{{route('register')}}">Não tem conta? Cadastre-se</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

  {{-- JQuery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/app.js"></script>
@endsection
