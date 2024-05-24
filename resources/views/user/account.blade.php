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

@include('layouts/menu') {{-- Adiciona menu --}}

{{-- Conteudo --}}
@section('content')

    @if(auth()->check() && auth()->user()->id == $user->id)
        @section('title', 'Paçoca - Minha Conta')
    @else
        @section('title', 'Paçoca - ' . $user->user_name)
    @endif


    {{-- Informações da conta --}}
    <div class="container container-account" style="padding-bottom: 100px; position: relative">

        @if (session('resent'))
            <div class="alert alert-success alert-dismissible alert-account fade show" role="alert" style="top: 10px; z-index: 9999!important; position: absolute; width: 100%">
                {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail. Verifique também sua caixa de spam') }}
            </div>
        @endif

        {{-- MENSAGEM DE CONTA CRIADA --}}
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible alert-account fade show" role="alert" style="top: 10px; z-index: 9999!important; position: absolute; width: 100%">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- MENSAGEM DE CONTA NÃO CRIADA --}}
        @if(session()->has('danger'))
            <div class="alert alert-danger alert-dismissible alert-account fade show" role="alert" style="top: 10px; z-index: 9999!important; position: absolute; width: 100%">
                {{session('danger')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- MENSAGEM DE CONTA EDITADA --}}
        @if(session()->has('account-edit-sucess'))
            <div class="alert alert-success alert-dismissible alert-account fade show" role="alert" style="top: 10px; z-index: 9999!important; position: absolute; width: 100%">
                Conta atualizada com sucesso
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        {{-- INFORMAÇÕES DA CONTA --}}
        <div class="row">
            <div class="col-8 col-name-user" style="margin-bottom: 20px!important">
                <h2>{{ $user->name }} {{-- Nome --}}
                    {{-- IMAGEM DE VERIFICADO --}}
                    @if ($user->user_name == 'joao' || $user->user_name == 'pacoca')
                        <img class="img-verificado-conta" src="{{asset('img/verificado.png')}}" alt="" srcset="">
                    @endif
                </h2>

                <p style="margin-bottom: 0px">{{"@" . $user->user_name }}</p>{{-- Nome de usuario --}}



                <div class="seguidores" style="display: flex; flex-direction: collumn; width: 150%; margin-bottom: 20px; flex-wrap: wrap;">
                    <div class="div">
                        {{count($posts)}} publicações
                        <span class="span-seguidores">-</span>
                    </div>
                    <div class="div" style="display: flex; flex-wrap: nowrap">
                    </div>

                    <div class="div">
                        <span id="numero-seguidor">{{count($user_controller->getFollowers($user->id))}}</span> seguidores<span class="span-seguidores">-</span>
                    </div>

                    <div class="div">
                        {{$user_controller->getFollowing($user->id)}} <span>seguindo</span>
                    </div>
                </div> {{-- Seguidores --}}


                {{-- Caso tenha link --}}
                @if($user->site)
                    <p>Link: <a href="{{ $user->site }}">{{ $user->site }}</a></p>
                @endif

                @if($user->biography)
                    <p> {{$user->biography}}</p>
                @endif

                {{-- Caso a conta seja do usuário logado --}}
                @if(auth()->check() && auth()->user()->id == $user->id)
                    {{-- Editar --}}
                    <a href="/edit" class="btn btn-blue" style="width: 100%;">Editar</a>
                @else
                @php
                    // Verifica se usuario logado está seguindo usuário da conta
                    if(auth()->check()){
                        $is_following = $user_controller->is_following($user->id); //tempo de postagem
                    }else{
                        $is_following = false;
                    }
                @endphp
                    @if(auth()->check())

                    {{-- verificar se email está verificado --}}
                    @php
                        if(auth()->user()->email_verified_at){
                            $email_verify = true;
                        }else{
                            $email_verify = false;
                        }
                    @endphp


                    {{--
                        email não verificado retorna modal para verificar email:
                        @if(!$email_verify) data-bs-toggle="modal" data-bs-target="#modal-verificar-email" @endif

                    --}}
                        {{-- @if(auth()->check() && auth()->user()->email_verified_at) só usuario com email verificado realiza ação --}}
                            {{-- Seguir --}}
                            <div class="row">
                                <div class="col-6">
                                    @if($is_following)
                                        <a @if(!$email_verify) data-bs-toggle="modal" data-bs-target="#modal-verificar-email" @endif class="btn btn-blue @if($email_verify)follow-user follow-user-{{$user->id}}@endif" data-user="{{$user->id}}" style="width: 100%; background: #979797!important;">
                                            Deixar de Seguir
                                        </a>
                                    @else
                                        <a @if(!$email_verify) data-bs-toggle="modal" data-bs-target="#modal-verificar-email" @endif class="btn btn-blue @if($email_verify)follow-user follow-user-{{$user->id}}@endif" data-user="{{$user->id}}" style="width: 100%;">
                                            Seguir
                                        </a>
                                    @endif
                                    {{-- @else
                                        @if($is_following)
                                            <a  data-bs-toggle="modal" data-bs-target="#modal-verificar-email" class="btn btn-blue follow-user" style="width: 100%; background: #979797!important;">
                                                Deixar de Seguir
                                            </a>
                                        @else
                                            <a  data-bs-toggle="modal" data-bs-target="#modal-verificar-email" class="btn btn-blue follow-user" data-user="{{$user->id}}" style="width: 100%;">
                                                Seguir
                                            </a>
                                        @endif
                                    @endif --}}
                                @else
                                    <a href="/login" class="btn btn-blue" style="width: 100%;">
                                        Seguir
                                    </a>
                                @endif

                        </div>
                        <div class="col-6">
                            <a href="/chat/{{$user->id}}" class="btn btn-gray" style="width: 100%;">
                                Conversar
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-4 col-img-conta">

                {{-- Imagem da conta --}}
                @if($user->img_account)
                    {{-- <img src="{{$user->img_account}}" class="img-conta" srcset=""> --}}
                    <div class="img-conta-perfil" style="background-image: url('{{$user->img_account}}')"></div>
                @else
                    <img src="../img/img-account.png" class="img-conta" srcset="">
                @endif
            </div>
        </div>

        <div class="row mt-3">
            <div class="hr"></div>
        </div>

        {{-- Filtro (imagens, texto, tudo) --}}
        <div class="row row-filtro-account">
            {{-- Icon img --}}
            <div class="col" @if(!isset($_GET['fillter'])) style="border-bottom: 2px solid #000" @endif>
                <a href="/{{$user->user_name}}">
                    @if(!isset($_GET['fillter']))
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-fillter bi bi-image-fill" viewBox="0 0 16 16">
                            <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                        </svg>
                    @else
                        <svg style="opacity: 0.5;" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-fillter bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                        </svg>
                    @endif
                </a>
            </div>

            {{-- Icon text --}}
            {{-- <div class="col"  @if(isset($_GET['fillter']) && $_GET['fillter'] == 'text') style="border-bottom: 2px solid #000" @endif>
                <a href="/{{$user->user_name}}?fillter=text">
                    @if(isset($_GET['fillter']) && $_GET['fillter'] == 'text')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-fillter bi bi-chat-square-text-fill" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                        </svg>
                    @else
                        <svg style="opacity: 0.5;" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-fillter bi bi-chat-square-text" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    @endif
                </a>
            </div> --}}

            {{-- Icon all --}}
            <div class="col" @if(isset($_GET['fillter']) && $_GET['fillter'] == 'all') style="border-bottom: 2px solid #000" @endif>
                <a href="/{{$user->user_name}}?fillter=all">
                    @if(isset($_GET['fillter']) && $_GET['fillter'] == 'all')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-fillter bi bi-postcard-heart-fill" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2Zm6 2.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0Zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622ZM2 5.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z"/>
                        </svg>
                    @else
                        <svg style="opacity: 0.5;" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-fillter bi bi-postcard-heart" viewBox="0 0 16 16">
                            <path d="M8 4.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7Zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622ZM2.5 5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Z"/>
                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2Z"/>
                        </svg>
                    @endif
                </a>
            </div>
        </div>

        <div class="row">
            <div class="hr"></div>
        </div>

        <div class="row" style="justify-content: start">
            {{-- POSTS EM IMAGEM --}}
            @if(!isset($_GET['fillter']))

                @if($posts == "[]")
                    <h1 style="text-align: center;margin-top: 50px">Nenhuma imagem publicada</h1>
                @endif

                @foreach ($posts as $post)

                    @php
                        $images_post = $post_controller->getImagesPost($post->id);
                    @endphp
                    {{-- SE FOR VIDEO --}}
                    @if(isset($images_post[0]))
                        @if ($images_post[0]->type)
                        <div class="col-lg-4 col-6" style="margin-top: 10px">
                            <div class="card card-post-account">
                                <video autoplay style="height: 100%" class="video-post-img" controls src="{{$images_post[0]->path}}"></video>
                            </div>
                        </div>
                        @else
                            <div class="col-lg-4 col-6" style="margin-top: 10px">
                                @php
                                    //verificar se img existe
                                    $path = $images_post[0]->path;

                                    if (file_exists($path)) {
                                        $path_img = asset($images_post[0]->path);
                                    } else {
                                        $path_img = asset('img/image_not_found.png');
                                    }
                                @endphp

                                <div type="button" data-bs-toggle="modal" data-bs-target="#modal-img-{{$images_post[0]->id}}" class="card card-post-account" style="background-image: url('{{ $path_img }}'); margin: 0px 0;"></div>

                                <div class="modal modal-fundo-black fade modal-view-img" id="modal-img-{{$images_post[0]->id}}" tabindex="-1" aria-labelledby="modal-img-{{$images_post[0]->id}}" aria-hidden="true">
                                    <button class="button-x-modal" type="button" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </button>

                                    <div class="modal-dialog modal-dialog-grande" style="max-width: fit-content;margin: 0 auto!important; justify-content: center;
                                    align-items: center;
                                    display: flex;">
                                        <div class="modal-content modal-content-grande" style="background: transparent !important;border: 0 !important;">
                                            <div class="modal-body modal-body-grande" style="display: flex;justify-content: center;">
                                                @php
                                                    //verificar se img existe
                                                    $path = $images_post[0]->path;

                                                    if (file_exists($path)) {
                                                        $path_img = asset($images_post[0]->path);
                                                    } else {
                                                        $path_img = asset('img/image_not_found.png');
                                                    }
                                                @endphp
                                                <img style="min-width: auto; max-width: fit-content;"  src="{{$path_img}}" id="img-post" class="img-post" srcset="">

                                                    <script>
                                                        function verificarOrientacaoImagem(urlDaImagem) {
                                                            var img = new Image();
                                                            img.onload = function() {
                                                                var largura = this.width;
                                                                var altura = this.height;
                                                                var elementoImg = document.getElementById('img-post');

                                                                if (largura > altura) {
                                                                    // console.log("Imagem está na orientação paisagem (deitada).");
                                                                    // elementoImg.style.width = "1000px";
                                                                } else if (largura < altura) {
                                                                    // console.log("Imagem está na orientação retrato (em pé).");
                                                                    elementoImg.style.maxWidth = "fit-content";
                                                                    // elementoImg.style.minWidth = "fit-content";
                                                                } else {
                                                                    // console.log("Imagem está na orientação quadrada.");
                                                                }
                                                            };
                                                            img.src = urlDaImagem;
                                                        }

                                                        // Exemplo de uso
                                                        verificarOrientacaoImagem("{{$path_img}}");
                                                    </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach

            {{-- POSTS EM TEXTO --}}
            @elseif(isset($_GET['fillter']) && $_GET['fillter'] == 'text')
                @if($posts == "[]")
                    <h1 style="text-align: center;margin-top: 50px">Nenhum texto publicado</h1>
                @endif

                @foreach ($posts as $post)
                    @if(!$post->img)
                        <div class="col-4" style="margin-top: 10px">
                            <div class="card card-post-text" style="">{{ $post->text }}</div>
                        </div>
                    @endif
                @endforeach

            {{-- TODOS OS POSTS --}}
            @elseif(isset($_GET['fillter']) && $_GET['fillter'] == 'all')
                <div class="col-5 col-info-user">
                    <h4>Informações Pessoais</h4><br>
                    <p>Conta criada em: {{ $user->created_at->format('d/m/Y') }}</p>
                    {{-- <p>Email: {{ $user->email }}</p> --}}
                    {{-- @if($user->phone)
                        <p>Telefone: {{ $user->phone }}</p>
                    @endif --}}
                    @if($user->birth_date)
                        <p>Aniversario: {{ date('d/m/Y', strtotime($user->birth_date)) }}</p>
                    @endif
                    @if($user->sexo)
                        <p>Sexo: {{ $user->sexo }}</p>
                    @endif
                </div>
                <div class="col">
                    {{-- Caso o usuário não tenha post --}}
                    @if($posts == "[]")
                        <h1 style="text-align: center;margin-top: 50px">Nenhuma publicação</h1>
                    @endif

                    {{-- TODOS OS POSTS --}}
                    @include('user.posts')

            @endif
        </div>
    </div>

    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
