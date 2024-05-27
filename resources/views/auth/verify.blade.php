{{-- @extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu endereço de e-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail. Verifique também sua caixa de spam') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, verifique se há um link de verificação em seu e-mail.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para solicitar outro') }}</button>.
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
        <div class="col col-form-login" style="font-size: 20px; margin-top: -30px">

            @if (session('resent'))
                <div style="margin: -70px 30px 40px 30px;" class="alert alert-success" role="alert">
                    {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail. Verifique também sua caixa de spam') }}
                </div>
            @endif

            <div id="form-open-loading" style="padding: 0 30px;">
                <h2 class="titulo-login">Verificação de email</h2>

                {{ __('Antes de continuar, ') }}
                {{-- {{ __('Se você não recebeu o e-mail,') }} --}}
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para enviar um email de verificação.') }}</button>.
                </form>

            </div>

            {{-- Spinner carregamento --}}
            <div class="row show-spinner mt-5" style="display: none">
                <div class="col" style="justify-content: center; display: flex;">
                    <div style="border-width: 5px!important; height: 50px;width: 50px; color: #5bb4ff" class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


  {{-- JQuery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/app.js"></script>

@endsection


