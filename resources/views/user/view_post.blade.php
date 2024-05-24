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

    <div class="container container-feed" style="margin-top: 76px; min-width: 100%!important; min-height: 100vh">
        <div class="row" style="justify-content: center;">
            
            <div class="col-md-4">
                {{-- Caso não tenha post --}}
                @if($posts == "[]")
                    <h1 style="text-align: center; margin-top: 50px">Essa publicação não existe ou foi excluida</h1>
                @endif
                {{-- Pega posts do arquivo user/posts.blade.php --}}
                @include('user.posts')
            </div>
        </div>
    </div>
    {{-- MENU DE CELULAR --}}
    @include('layouts/menu_mobile')
@endsection
