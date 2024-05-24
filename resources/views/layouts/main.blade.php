<!DOCTYPE html>
<html lang="pt-BR" style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        /* Estilo para ocultar a página inicialmente */
        body {
            opacity: .8;
            visibility: hidden;
            transition: opacity 0.3s ease-in;
        }
        /* Estilo para exibir a página após o carregamento completo */
        body.loaded {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <script>
        // Função para adicionar a classe CSS quando a página estiver carregada
        window.addEventListener('load', function() {
          document.body.classList.add('loaded');
        });
      </script>
    <link rel="shortcut icon" href="{{asset('img/pacoca.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/style.css?v=2')}}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body style="height: 100%; overflow-x: hidden;"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">{{-- TOKEN PARA O CURTIR FUNCIONAR --}}   
    @yield('menu') {{-- Caso tenha menu --}}
    @yield('content') {{-- Contudo --}}
    @yield('footer'){{-- footer --}}   
</body>
</html>