@extends('painel.base')

@section('content')

        <div class="alert alert-primary" role="alert">
            <h3>Editar Aula</h3>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erro)
                <li>{{$erro}}</li>
                @endforeach
            </ul>
            </div>
        @endif
        
        <form method="POST" action="{{route('painel.editaaula.salvar', $aula->id)}}">

            @csrf
            
            <div class="form-group mb-2">
                <label for="nome">Nome da Aula</label>
                <input type="text" name="nome" class="form-control" value="{{$aula->nome}}" required>  
            </div>

            <div class="form-group mb-2">
                <label for="professor">Professor</label>
                <input type="text" name="professor" class="form-control" value="{{$aula->professor}}" required>  
            </div>

            <div class="form-group mb-2">
                <label for="duracao">Duração (Minutos)</label>
                <input type="number" min="1" max="60" name="duracao" class="form-control" value="{{$aula->duracao}}" required>  
            </div>

            <div class="form-group mb-2">
                <label for="qtdemaxalunos">Qtde Máx. Alunos</label>
                <input type="number" name="qtdemaxalunos" class="form-control" value="{{$aula->qtdemaxalunos}}" required>  
            </div>

            <div class="form-group mb-2">
                <label for="data">Data</label>
                <input type="date" name="data" class="form-control" value="{{$aula->data}}" required>  
            </div>

            <div class="form-group mb-2">
                <label for="hora">Hora</label>                                
                <input type="time" name="hora" class="form-control" value="{{\Carbon\Carbon::parse($aula->hora)->format('H:m')}}" required>  
            </div>

            <button type="submit" class="btn btn-primary">Editar</button>

        </form>

        <br/>
        <br/>
        <a href="{{route('painel.dashboard')}}"  class="btn btn-link">Voltar para Dashboard</a>

@endsection