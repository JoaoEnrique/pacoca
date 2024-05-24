@extends('layouts.main')

<script>
    const confirmDelete = (url)=>{
        if(confirm("Deseja apagar a conta? Não é possivel recuperar.")){
   				document.location = url;
        }
    }
</script>
@section('content')
    <div class="container">
        <h1 class="titulo-listar">Usuários</h1>

        <div class="div-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{  $user->id  }} </td>
                            <td><a href="/users/books/{{$user->id}}">{{  $user->name  }}</a></td>
                            <td>{{  $user->email  }} </td>
                            <td>
                                <a onclick="confirmDelete('/delete/user/{{$user->id}}')" class="btn btn-danger">Excluir</a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
                