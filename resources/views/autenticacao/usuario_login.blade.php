@extends('autenticacao.base')
@section('content')

<form class="form-signin" method="POST" action="{{route('login.autenticar')}}">
  
  <img class="mb-4" src="{{asset('img/user_login.png')}}" alt="Logo" width="250" height="120">

  <h1 class="h3 mb-3 font-weight-normal">Acesse o Sistema</h1>

  <hr/>
    @if (session('loginError'))            
          <div class="alert alert-danger">
                  {{ session('loginError') }}
          </div>        
    @endif

    @if (session('loginInfo'))            
          <div class="alert alert-info">
                  {{ session('loginInfo') }}
          </div>        
    @endif


  
  @csrf

  <label for="email" class="sr-only">E-mail de Acesso</label>
  <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>

  <label for="password" class="sr-only">Senha de Acesso</label>
  <input type="password" name="password" class="form-control" placeholder="********" required>  
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

  <p>Não possui cadastro ?<br/>Cadastre-se <a href="{{route('login.novo.usuario')}}">Aqui</a></p>
  <br/>
  <p><a href="{{route('aula.listagem')}}">Voltar Página Inicial</a></p>
  
  <p class="mt-2 mb-2 text-black">&copy; Gerenciador de Aulas - {{date('Y')}} </p>

</form>

@endsection