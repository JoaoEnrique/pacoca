<nav class="navbar navbar-pc navbar-dark navbar-expand-md fixed-top" style=" padding-left:100px;padding-right: 100px;    margin: 0 20px 20px; border-radius: 15px">
    <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="{{asset('img/pacoca.png')}}" height="50"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                {{-- Formulario de pesquisa --}}
                <form class="d-flex" method="GET" action="/search" role="search" style="margin: 0;">
                    @csrf
                    <input class="form-control me-2" type="search" name="search" placeholder="Pesquisar" aria-label="Search" required>
                    <button class="btn btn-outline-blue" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
                            <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018Z"/>
                            <path d="M13 6.5a6.471 6.471 0 0 1-1.258 3.844c.04.03.078.062.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1.007 1.007 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5ZM6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11Z"/>
                        </svg>
                    </button>
                </form>
            </li>

        </ul>

        <div class="d-flex" role="search" style="align-items:center; margin-right: 50px;">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="gap: 20px!important">
                {{-- Usuario Logado mostra icones de configurações  --}}
                @if (auth()->check())
                    <li class="nav-item  @if(Request::is('/')) active @endif">
                        <a class="nav-link" href="/">
                            {{-- Caso esteja na home (img preenchida) --}}
                            @if(Request::is('/'))
                                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" fill="currentColor" class="icon-menu bi bi-house-door-fill" viewBox="0 0 16 16">
                                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                                </svg>
                            @else
                            {{-- Caso não esteja na home (img normal) --}}
                                <svg style="opacity: 0.5" xmlns="http://www.w3.org/2000/svg" height="25" width="25" fill="currentColor" class="icon-menu bi bi-house-door" viewBox="0 0 16 16">
                                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
                                </svg>
                            @endif
                        </a>
                    </li>

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

                    <li class="nav-item  @if(Request::is('chat')) active @endif">
                        <a class="nav-link" href="/chat">
                            {{-- Caso esteja na home (img preenchida) --}}
                            @if(Request::is('chat'))
                                <img src="{{asset('img/chat-black.png')}}" height="35" srcset="">
                            @else
                                {{-- Caso não esteja na home (img normal) --}}
                                <img style="opacity: 0.5" src="{{asset('img/chat.png')}}" height="35" srcset="">
                            @endif
                        </a>
                    </li>

                    {{-- CRIAR POST --}}
                    <li class="nav-item">
                        <a @if(!$email_verify) data-bs-toggle="modal" data-bs-target="#modal-verificar-email" @endif type="button" @if($email_verify)data-bs-toggle="modal" data-bs-target="#modal-post" class="nav-link" href="/"@endif>
                            <svg style="opacity: 0.5" xmlns="http://www.w3.org/2000/svg" height="25" width="25" fill="currentColor" class="icon-menu bi bi-plus-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </a>
                    </li>

                    @php
                        if (auth()->user()->img_account){ //-- Caso o usuario tenha uma imagem
                                $img_conta = auth()->user()->img_account;
                        }else{//Caso o usuario não tenha uma imagem (mostra imagem de conta)
                                $img_conta = "../img/img-account.png";
                        }
                    @endphp


                        {{-- NOTIFICAÇÔES - CORAÇÂO --}}
                        {{-- VERIFICA SE TEM NOVAS NOTIFICAÇÕES --}}
                        @php
                        $notification_controller = app(App\Http\Controllers\NotificationController::class);
                        $have_notification = $notification_controller->haveNotification(auth()->user()->id)
                    @endphp
                @if(Request::path() === 'notification')
                    <li class="nav-item active">
                        <a class="nav-link position-relative" href="/notification">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-menu bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                            @if ($have_notification)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{$have_notification}}
                                <span class="visually-hidden">unread messages</span>
                            @endif
                        </a>

                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="/notification">
                            <svg style="opacity: 0.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon-menu bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg>
                            @if ($have_notification)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{$have_notification}}
                                <span class="visually-hidden">unread messages</span>
                            @endif
                        </a>
                    </li>
                @endif

                    {{-- Conta do usuário --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle img-menu" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-image: url('{{$img_conta}}')!important;">

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/{{auth()->user()->user_name}}">Conta</a> {{-- Abre conta --}}
                            </li>

                            {{-- Sai da conta --}}
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                >
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                    {{-- Usuário Não logado --}}
                    @else
                        <a href="/login" class="btn btn-outline-blue">Fazer login</a>
                    @endif
                </li>
            </ul>
        </div>
        </div>
    </div>
</nav>


{{-- ADICIONAR PUBLICAÇÃO --}}
<div class="col-10">
    <form class="form-post" method="POST" action="/post" enctype="multipart/form-data">
        @csrf
        {{-- video/mp4, video/webm --}}
        {{-- Campo de texto --}}

        <!-- MODAL DE ADICIONAR IMAGEM NA PUBLICAÇÃO -->
        <div class="modal fade" id="modal-post" tabindex="-1" aria-labelledby="modal-post" aria-hidden="true">

            <div class="modal-dialog">
                <div id="username-suggestions"></div>
                <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0!important;">
                    <h5 class="modal-title" id="modal-post">Publicação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="comment-text" class="form-control text-comment mb-2" type="text" name="text" placeholder="Texto da publicação" required></textarea>

                    {{-- ERRO ARQUIVO GRANDE --}}
                    @error('img')
                        <span class="invalid-feedback" role="alert" style="text-align: left">
                            {{$message}}
                        </span>
                    @enderror

                    {{-- ERRO ARQUIVO GRANDE --}}
                    @error('video')
                        <span class="invalid-feedback" role="alert" style="text-align: left">
                            {{$message}}
                        </span>
                    @enderror

                    <label id="icon-add-img" for="img" style="cursor: pointer">
                        {{-- ICONE DE IMAGEM --}}
                        {{-- <svg id="icon-add-img"  xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="icon-img-post bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                        </svg> --}}
                        <img src="https://takenotes.x10.mx/img/add-image.png" class="img-add-file" srcset="">
                    </label>

                    <label id="icon-add-img" for="video" style="cursor: pointer">
                        {{-- ICONE DE VIDEO --}}
                        {{-- <svg style="margin-left: 10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="icon-img-post bi bi-play-btn-fill" viewBox="0 0 16 16">
                            <path d="M0 12V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm6.79-6.907A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                        </svg> --}}

                        <img src="https://takenotes.x10.mx/img/add-video.png" class="img-add-file" srcset="">
                    </label>

                    {{-- Campo de imagem --}}
                    <input type="file" class="d-none" name="img" id="img" accept="image/*">

                    {{-- Campo de video --}}
                    <input type="file" class="d-none" name="video" id="video" accept="video/mp4, video/webm">

                    {{-- Previewa --}}
                    <div class="row" style="display: flex; overflow: auto;">
                        <div class="row" style="margin: 0;">
                            {{-- PREVIEW IMG --}}
                            <label class="label-img label-img" for="img"></label>
                        </div>
                        <div class="row" style="margin: 0;">
                            {{-- PREVIEW VIDEO --}}
                            <label class="label-img label-video" for="video">
                                <video  controls="controls" class="video-post img-account-comment" srcset="" style="width: 100%;height: 100%; margin: 0 5px;">
                                    <source src="" type="video/mp4">
                                </video>
                            </label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-blue">Postar</button>
                </div>
                </div>
            </div>
        </div>

    </form>
</div>
