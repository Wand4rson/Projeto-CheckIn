@extends('autenticacao.base')
@section('content')

<form class="form-signin" method="POST" action="{{route('login.novo.usuario.salvar')}}">
  
  <img class="mb-4" src="{{asset('img/user_novo.png')}}" alt="Logo" width="250" height="120">

  <h1 class="h3 mb-3 font-weight-normal">Novo Usuário</h1>

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

      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $erro)
              <li>{{$erro}}</li>
            @endforeach
          </ul>
        </div>
      @endif


  @csrf
    

  <select class="form-select mb-3" aria-label="Tipo de Usuario" name="tipocadastro" id="tipocadastro">  
    <option selected value="admin">Administrador</option>
    <option value="aluno">Aluno</option>  
  </select>

  <label for="name" class="sr-only">Nome de Usuário</label>
  <input type="text" name="name" class="form-control" placeholder="Nome de Usuário" required autofocus>

  <label for="email" class="sr-only">E-mail de Acesso</label>
  <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>

  <label for="password" class="sr-only">Senha de Acesso</label>
  <input type="password" name="password" class="form-control" placeholder="Senha de Acesso" required>  

  <label for="password_confirmation" class="sr-only">Confirme a senha de Acesso</label>
  <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a senha de Acesso" required>  
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

  <p>Já possui cadastro ?<br/>Efetue seu Login <a href="{{route('login')}}">Aqui</a></p>
  <br/>
  <p><a href="{{route('aula.listagem')}}">Voltar Página Inicial</a></p>

  <p class="mt-2 mb-2 text-black">&copy; Gerenciador de Aulas - {{date('Y')}} </p>


</form>

@endsection