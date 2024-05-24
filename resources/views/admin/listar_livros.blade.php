@extends('layouts.main')
@section('title', 'Pagina principal')

@section('content')
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -50px!important;margin-bottom: 50px!important;">
            <strong>Site desenvolvido pelo melhor! 😎</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <h1  class="text-center titulo-livros">Livros de {{$user->name}}</h1>
        @if ($livros != "[]")
            <p class="text-center text-quantidade-livros">{{$quantidadeLivrosLidos}} livros terminados de {{$quantidadeLivros}} livros</p>
        @endif

        {{-- BOTÃO ADICIONAR LIVRO --}}
        <a class="btn-adicionar-livro" href="/criar">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
            </svg>
        </a>

        
        <!-- NOTIFICACAO DE EXCLUSÃO -->
        <?php
         if(isset($_GET['exc'])){ 
            if($_GET['exc'] == 'sucess'){ ?> 
                <!-- MENSAGEM DE CONTA CRIADA-->
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -50px!important;margin-bottom: 50px!important;">
                    <strong>Livro Excluido com sucesso!</strong>
                    <button onclick="window.location.href = '/livros'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <!-- MENSAGEM DE CONTA NÃO CRIADA-->
            <?php }elseif($_GET['exc'] == 'danger'){ ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert" style="margin-top: -50px!important;margin-bottom: 50px!important;">
                    <strong>Não foi possível excluir o livro.</strong> Tente novamente mais tarde.
                    <button onclick="window.location.href = '/livros'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }
        } ?>
        
        <div class="row row-pesquisa-livro" style="margin-bottom: 100px">
            <div class="col">
                <form class="d-flex" method="GET" action="/pesquisa"> 
                    @csrf
                    <input class="form-control me-2" type="search" id="livro" name="livro" placeholder="Nome do Livro" aria-label="Search">
                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>

        <div class="row">

            @if ($livros == "[]")
                <h1 class="text-center">Esse usuário não cadastrou nenhum livro</h1>
            @else
                @foreach ($livros as $livro)
                    <div class="col col-livro">
                        <a class="link-livro" href="/livro?id={{ $livro->id_livro }}">
                            <div class="livro"  @if ($livro->img_livro) style="background-image:url('../{{ $livro->img_livro }}');" @else style="background-image:url('../img/book_transparent.png');" @endif>

                                    @if ($livro->img_livro == null)
                                        <h1>{{ $livro->nome_livro }}</h1>
                                    @endif
                            </div>
                        </a>
                    </div>
                @endforeach   
            @endif
        </div>
    </div>
@endsection