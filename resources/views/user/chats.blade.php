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
{{-- @include('layouts/menu') --}}

@section('content')

    <div class="row row-list-chat">
        {{-- TODAS AS CONVERSAS --}}
        <div class="col-3 col-list-chat">
            <div class="choose-chat list-chat row" data-chat-id="0">
                <div class="choose-chat col-1" style="margin-right: 30px;display: flex; align-items: center" data-chat-id="0">
                    <div class="choose-chat img-list-chat" style="background-image: url('{{asset('img/img_account/2.png')}}')!important" data-chat-id="0"></div>
                </div>
                <div class="choose-chat col" style="display: flex; align-items: center" data-chat-id="0">
                    <h4 class="choose-chat" data-chat-id="0">Paçoca</h4>
                </div>
            </div>
            @foreach ($chats as $chat)
                @foreach ($members as $member)
                    @if ($member->chat_id == $chat->chat_id)
                        {{-- Imagem da conta no post --}}
                        @php
                            if($member->img_account){
                                $img_account =$member->img_account;
                            }else{
                                $img_account = asset('img/img-account.png');
                            }
                        @endphp
                        <div class="choose-chat list-chat row" data-chat-id={{$chat->chat_id}}>
                            <div class="choose-chat col-1" style="margin-right: 30px;display: flex; align-items: center" data-chat-id={{$chat->chat_id}}>
                                <div class="choose-chat img-list-chat" style="background-image: url('{{$img_account}}')!important" data-chat-id={{$chat->chat_id}}></div>
                            </div>
                            <div class="choose-chat col" style="display: flex; align-items: center" data-chat-id={{$chat->chat_id}}>
                                <h4 class="choose-chat" data-chat-id={{$chat->chat_id}}>{{$member->name}}</h4>
                            </div>
                        </div>

                    @endif
                @endforeach
            @endforeach
        </div>

        {{-- Conversa --}}
        <div class="col col-conversa">
            <div class="row">
                <div>
                    <div class="list-chat row">
                        @include('user.menu_chat')

                        <div class="col-1" style="margin-right: 30px;display: flex; align-items: center">
                            <div id="chat-img" class="img-list-chat" style="background-image: url('{{asset('img/img_account/2.png')}}')"></div>
                        </div>
                        <div class="col" style="display: flex; align-items: center">
                            <h4 class="choose-chat" id="chat-name" data-chat-id="0">Paçoca</h4>
                        </div>
                        <button style="margin: auto 20px auto;" type="button" class="choose-chat btn-close" aria-label="Close"></button>
                    </div>
                </div>

                <div id="chat-loading" class="chat-loading">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only"></span>
                      </div>
                </div>

                <div id="chat-conteudo" class="chat">

                    <div class="div-text-chat">
                        <div class="text-user-nao-logado">
                            <p>Olá, Esse é um exemplo de chat, agora você pode conversar com quem quiser e com privacidade.</p>
                        </div>
                    </div>

                    <div class="div-text-chat">
                        <div class="text-user-nao-logado">
                            <p>Vá até o perfil de um usuário para acessar o chat com ele(a)</p>
                        </div>
                    </div>

                    <div class="div-text-chat">
                        <div class="text-user-nao-logado">
                            <p>Usamos criptografia de ponta a ponta.</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="div-text-chat div-text-chat-logado">
                    <div class="text-user-logado">
                        Olá, novo chat do Paçoca
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col" id="form-escrever-chat" style="display: none">
                    <form id="form-chat" class="form-chat" method="POST" action="/send-message-chat">
                        <input value="{{$chat_id}}" name="chat_id" id="chat_id" type="hidden">
                        @csrf
                        <textarea class="form-control textarea-chat me-2" type="text" id="text" name="text" placeholder="Escrever" required></textarea>
                        <button class="btn btn-blue button-submit-chat" type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
    <script src="{{asset('js/chat.js')}}"></script>
@endsection
