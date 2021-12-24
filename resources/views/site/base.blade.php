<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">            
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Gerenciador de Aulas</title>    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    
     <!-- Icons fontawesome -->        
    <link href="{{asset('icons/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('icons/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('icons/css/solid.css')}}" rel="stylesheet">
    



</head>

<body>
      
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="{{route('painel.dashboard')}}">Gerenciador de Aulas</a>                        
    </nav>

    <div class="text-center mt-5">
                <br/>  
        @yield('content')
    </div>
    

    @include('sweetalert::alert')
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>