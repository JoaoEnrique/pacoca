@extends('layouts.main')
@section('title', 'Read Book')

@section('content')
    <main class="main-index container-index">
        <div class="container">
            <div class="row row-index">
                {{-- <h1 class="text-center">Entre para cadastrar seus livros</h1> --}}
                <div class="col col-index">
                    <h1 class="text-white">Livros Lidos</h1>
                    <p class="text-white">Cadastre os livros que você leu ou está lendo para manter um controle de todas as informações dos livros lidos por você. Desenvolvido pelo <a target="_BLANK" href="https://www.linkedin.com/in/jo%C3%A3oenrique/">João Enrique.</a></p>
                    <a href="/register" class="btn btn-outline-light">Criar Conta</a>
                </div>
                <div class="col col-index">
                    <img src="{{asset('img/read_book_livro.png')}}" height="800" srcset="">
                </div>
            </div>
        </div>
    </main>
@endsection