@extends('painel.base')

@section('content')

        <div class="alert alert-primary" role="alert">
            <h3>Editar Usuário</h3>
        </div>

        @if (session('passEdit'))            
            <div class="alert alert-danger">
                    {{ session('passEdit') }}
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
        
        <form method="POST" action="{{route('usuario.editar.salvar')}}">

            @csrf
            
            <div class="form-group mb-2">
                <label for="password_old">Antiga Senha de Acesso</label>
                <input type="password" name="password_old" class="form-control" placeholder="Antiga Senha de Acesso" required>  
            </div>

            <div class="form-group mb-2">                
                <label for="password">Nova Senha de Acesso</label>
                <input type="password" name="password" class="form-control" placeholder="Nova Senha de Acesso" required>  
            </div>

            <button type="submit" class="btn btn-primary">Editar</button>

        </form>

        <br/>
        <br/>
        <a href="{{route('painel.dashboard')}}"  class="btn btn-link">Voltar para Dashboard</a>

@endsection