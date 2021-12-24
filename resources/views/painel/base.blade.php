<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">            
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Gerenciador de Aulas - Painel</title>    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Icons fontawesome -->        
    <link href="{{asset('icons/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('icons/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('icons/css/solid.css')}}" rel="stylesheet">


</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-primary">
            <a class="navbar-brand" href="{{route('painel.dashboard')}}">Gerenciador de Aulas</a>            
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                                   
                    @if(Auth::user()->tipocadastro === 'admin')
                    
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('painel.novaaula.form')}}"><i class="fas fa-edit"></i> Nova Aula</a>
                        </li>

                    @elseif(Auth::user()->tipocadastro === 'aluno')

                        

                    @endif        

                    <li class="nav-item">
                        <hr/>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('usuario.editar.form')}}"><i class="fas fa-key"></i> Mudar Senha</a>
                    </li>   

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </li>  

                </ul>            
                
            </div>

        </nav>
    </header>
        
    <section class="container-fluid">               
        <div class="mt-5">
            <br/>
        
            @if (session('ErrorDashboard'))            
                <div class="alert alert-danger">
                        {{ session('ErrorDashboard') }}
                </div>        
            @endif
        
            <!-- Pagina de Conteudo -->
            @yield('content')
        </div>   

    </section>


    <footer class="footer mt-auto py-3" style="background-color :#f7f7f7;">
        <div class="container-fluid text-center">            
            <p class="text-muted">Gerenciador de Aulas</p>            
        </div>
    </footer>
    
    @include('sweetalert::alert')
    
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>