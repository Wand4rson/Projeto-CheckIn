<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">            
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Gerenciador de Aulas - Autenticação</title>    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Login CSS -->
    <link href="{{asset('css/login.css')}}" rel="stylesheet">

    <!-- Icons fontawesome -->        
    <link href="{{asset('icons/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('icons/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('icons/css/solid.css')}}" rel="stylesheet">    



</head>
<body class="text-center">    
    @yield('content')   
    
    
    @include('sweetalert::alert')
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>