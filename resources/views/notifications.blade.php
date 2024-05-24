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
    @php
        $user_controller = app(App\Http\Controllers\UserController::class);
        $notification_controller = app(App\Http\Controllers\NotificationController::class);
        $view_notification = $notification_controller->viewNotification(auth()->user()->id);
    @endphp

    <div class="container container-search">
        {{-- Caso não encontre nennhum resultado --}}
        @if($notifications == "[]")
            <h1>Nenhuma notificação</h1>
        @else
            <h1 class="title-notification">Notificações</h1><br><br>

            {{-- Lista todos os resultados com a pesquisa --}}
            @foreach ($notifications as $notification)
                @php
                    $user_controller = app(App\Http\Controllers\UserController::class);
                @endphp

                {{--  --}}
                <div class="row row-notification open-notification" data-id-notification="{{$notification->id}}" style="@if(!$notification->opened) background: #F5F5F5 @endif" onclick="window.location.href='{{$notification->link2}}'">
                    
                    {{-- @if($notification->img_notification) --}}
                        @php
                            if($notification->img_notification) {$img_notification = $notification->img_notification;}
                            else{ $img_notification = "../img/pacoca.png";  }

                        @endphp
                        
                        
                    <div class="col-1 img-list-chat img-account-search" style="background-image: url('{{$img_notification}}')!important">
                    </div>
                    <div class="col">
                        {{-- --}}
                        <h4><a class="name-search" href="{{$notification->link1}}">{{$notification->text}}</a></h4>
                        <p>{{$user_controller->dateDifference($notification->created_at)}}</p>
                    </div>
                </div>
            @endforeach
            
        @endif
    </div>
    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
