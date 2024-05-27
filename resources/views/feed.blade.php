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

@include('layouts/menu')

@section('content')
{{-- TOKEN PARA O CURTIR FUNCIONAR --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container container-feed" style="margin-top: 76px; min-width: 100%!important">
        <div class="row" style="justify-content: center;">

            <div class="col-md-4">
                @if (session('resent'))
                    <div class="mt-3 alert alert-success" role="alert">
                        {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail.') }}
                    </div>
                @endif

                <!-- No arquivo Blade -->
                @if(Session::has('mensagem'))
                    <div class="mt-3 alert alert-success" role="alert">
                        {{ Session::get('mensagem') }}
                    </div>
                @endif

                {{-- Caso não tenha post --}}
                @if($posts == "[]")
                    <h1>Siga pessoas para ver mais posts</h1>
                @endif
                <div class="card card-post card-create-post">

                    {{-- Erro de arquivos grandes --}}
                    @error('img')
                        <div class="alert alert-danger alert-dismissible alert-account-create fade show" role="alert" style="height: 70px; position: absolute; top:0; left: 0;">
                            <strong>Os Arquivos são muito grandes!</strong> Tente novamente com uma imagem menor.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    {{-- Erro de arquivos grandes --}}
                    @error('video')
                        <div class="alert alert-danger alert-dismissible alert-account-create fade show" role="alert" style="height: 70px; position: absolute; top:0; left: 0;">
                            <strong>Os Arquivos são muito grandes!</strong> Tente novamente com uma imagem menor.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <div class="row" style="width: 100%; margin: 0; padding: 0; flex-wrap: nowrap; ">
                        @php
                        if(isset(auth()->user()->img_account))
                            $img_account = auth()->user()->img_account;
                        else
                            $img_account = "../img/img-account.png";
                        @endphp
                        <div class="col-2 img-conta-pesquisa img-conta-post" style="background-image: url('{{$img_account}}')">

                        </div>

                        {{-- ADICIONAR PUBLICAÇÃO --}}
                        <div class="col" style="padding-right: 0">
                            <form class="form-post" style="" method="POST" action="/post" enctype="multipart/form-data">
                                @csrf
                                {{-- Campo de imagem --}}
                                <input type="file" class="d-none" accept="image/*">
                                {{-- Campo de texto --}}

                                {{-- verificar se email está verificado --}}
                                @php
                                    if(auth()->check() && auth()->user()->email_verified_at){
                                        $email_verify = true;
                                    }else{
                                        $email_verify = false;
                                    }
                                @endphp

                                {{--
                                    email não verificado retorna modal para verificar email:
                                    @if(!$email_verify) data-bs-toggle="modal" data-bs-target="#modal-verificar-email" @endif

                                --}}
                                {{-- ABRE MODAL DE POST - menu_mobile.blade.php --}}
                                <input @if(!auth()->check()) onclick="window.location.href='/login'"  @endif  @if(!$email_verify && auth()->check()) data-bs-toggle="modal" data-bs-target="#modal-verificar-email" @endif @if($email_verify && auth()->check()) type="button" data-bs-toggle="modal" data-bs-target="#modal-post" @endif class="form-control form-text-comment me-2" type="text" name="" value="Adicionar publicação"/>

                            </form>
                        </div>
                    </div>
                </div>
                {{-- Pega posts do arquivo user/posts.blade.php --}}
                @include('user.posts')

                <p style="text-align: center; margin-top: 20px">Fim das publicações</p>
            </div>
        </div>
    </div>
    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection


<script>
</script>
