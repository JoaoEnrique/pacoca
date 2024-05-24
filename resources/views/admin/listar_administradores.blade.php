<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web</title>
    <link rel="stylesheet" href="/css/style.css">

    @vite([
        'resources/js/app.js',
        'resources/css/app.css',
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.js'    
    ])
</head>
<body class="bg-secondary">
    <div class="container">
        <!-- NOTIFICACAO DE CADASTRO -->
        <?php
         if(isset($_GET['cad'])){ 
            if($_GET['cad'] == 'sucess'){ ?> 
                <!-- MENSAGEM DE CONTA CRIADA-->
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>Agendamento Realizado!</strong> Confira todos os agendamentos.
                    <button onclick="window.location.href = '/consulta'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <!-- MENSAGEM DE CONTA NÃO CRIADA-->
            <?php }elseif($_GET['cad'] == 'danger'){ ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <strong>Agendamento não Realizado!</strong> Não foi possível realizar um agendamento.
                    <button onclick="window.location.href = '/consulta'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }
        } ?>


        <!-- NOTIFICACAO DE EXCLUSÃO -->
        <?php
         if(isset($_GET['exc'])){ 
            if($_GET['exc'] == 'sucess'){ ?> 
                <!-- MENSAGEM DE CONTA CRIADA-->
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>Agendamento Excluido!</strong>
                    <button onclick="window.location.href = '/consulta'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <!-- MENSAGEM DE CONTA NÃO CRIADA-->
            <?php }elseif($_GET['exc'] == 'danger'){ ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <strong>Agendamento não excluido!</strong> Não foi possível excluir o agendamento.
                    <button onclick="window.location.href = '/consulta'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }
        } ?>

        <!-- NOTIFICACAO DE EDIÇÃO -->
        <?php
         if(isset($_GET['edit'])){ 
            if($_GET['edit'] == 'sucess'){ ?> 
                <!-- MENSAGEM DE CONTA CRIADA-->
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>Agendamento Atualizado!</strong>
                    <button onclick="window.location.href = '/consulta'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <!-- MENSAGEM DE CONTA NÃO CRIADA-->
            <?php }elseif($_GET['edit'] == 'danger'){ ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <strong>Agendamento não Atualizado!</strong> Não foi possível atualizar o agendamento.
                    <button onclick="window.location.href = '/consulta'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }
        } ?>

        <nav class="navbar navbar-dark navbar-expand-sm text-light bg-primary mt-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">SISTEMA  WEB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Cadastrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/consulta">Consulta</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="main bg-white">
            <div class="container px-5">
                <div class="row">
                    <div class="col mt-3">
                        <h4>Consultar - Contatos Agendados</h1>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Origem</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Observação</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($agendamentos as $agendamento)
                            <tr>
                                <td>{{  $agendamento->nome  }} </td>
                                <td>{{  $agendamento->telefone  }} </td>
                                <td>{{  $agendamento->origem  }} </td>
                                <td>{{  $agendamento->data_contato  }} </td>
                                <td>{{  $agendamento->observacao  }} </td>
                                <td>
                                    <a href="/editar?agendamento={{$agendamento->id}}" class="btn btn-primary">Editar</a> 
                                    <a href="/excluir?agendamento={{$agendamento->id}}" class="btn btn-danger">Excluir</a> 
                                </td>
                            </tr>
                            @endforeach
                        <tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>