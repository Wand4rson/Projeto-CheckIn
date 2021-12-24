    @extends('painel.base')

    @section('content')       

    <h3>Lista de Alunos Inscritos</h3>


    @if(count($inscritos) === 0 )
        <p class="text-muted">Nenhum registro encontrado</p>
    @else
       
        <table class="table table-bordered table-sm table-hover">
            <thead>
                <tr>            
                <th scope="col">ID do Aluno</th>
                <th scope="col">Nome do Aluno</th>
                <th scope="col">Data da Inscrição</th>                
                </tr>
            </thead>
            <tbody>

                @foreach($inscritos as $inscrito)
                    <tr>  
                        
                        <td>{{$inscrito->aluno->id}}</td>
                        <td>{{$inscrito->aluno->name}}</td>

                        <td>
                            @if(!@empty($inscrito->created_at))
                                {{date('d/m/Y', strtotime($inscrito->created_at))}}
                            @endif
                        </td>

                    </tr>             
                @endforeach

            </tbody>
	        </table> 


    @endif
    
    <br/>
    <br/>
    <a href="{{route('painel.dashboard')}}"  class="btn btn-link">Voltar para Dashboard</a>

        
        

@endsection
