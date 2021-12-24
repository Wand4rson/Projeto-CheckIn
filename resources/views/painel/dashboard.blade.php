    @extends('painel.base')

    @section('content')       

        @if(Auth::user()->tipocadastro === 'admin')
            <p class="text-center text-primary">Eu : {{Auth::user()->name}}, cadastrei as aulas.</p>
            <p class="text-center text-muted">Seu Cadastro é do Tipo : {{Auth::user()->tipocadastro}}</p>            
            <p class="text-center text-muted">Seu E-mail : {{Auth::user()->email}}</p>
                              
            <table class="table table-bordered table-sm table-hover">
            <thead>
                <tr>            
                <th scope="col">Dia</th>
                <th scope="col">Horario</th>
                <th scope="col">Nome Aula</th>
                <th scope="col">Professor</th>
                <th scope="col">Qtde. Máx. Alunos</th>
                <th scope="col">Qtde. Inscritos</th>
                <th scope="col">Ações </th>
                </tr>
            </thead>
            <tbody>

                @foreach($listaAdmin as $aulacriada)
                    <tr>        
                        <td>
                            @if(!@empty($aulacriada->data))
                                {{date('d/m/Y', strtotime($aulacriada->data))}}
                            @endif
                        </td>

                        <td>
                            @if(!@empty($aulacriada->hora))
                                {{date('H:i', strtotime($aulacriada->hora))}}
                            @endif
                        </td>

                        <td>{{$aulacriada->nome}}</td>
                        <td>{{$aulacriada->professor}}</td>                        
                        <td>{{$aulacriada->qtdemaxalunos}}</td>
                        <td>
                            <a href="{{route('painel.inscritosaula.form', $aulacriada->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lista de Alunos Inscritos">
                                {{$aulacriada->qtdeinscritos}}
                            </a>
                        </td>

                        <td>
                            <a href="{{route('painel.removeraula', $aulacriada->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Excluir</a>
                            <a href="{{route('painel.editaaula.form', $aulacriada->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>	                    			                            
                        </td>
                        
                    </tr>             
                @endforeach

            </tbody>
	        </table>    


            <small>{{'Qtde Registros :'.count($listaAdmin)}}</small>
            {{ $listaAdmin->links() }}



        @elseif(Auth::user()->tipocadastro === 'aluno')
            <p class="text-center text-primary">Eu : {{Auth::user()->name}}, estou inscrito nas aulas.</p>
            <p class="text-center text-muted">Seu Cadastro é do Tipo : {{Auth::user()->tipocadastro}}</p>
            <p class="text-center text-muted">Seu E-mail : {{Auth::user()->email}}</p>
            

            
                
            <table class="table table-bordered table-sm table-hover">
            <thead>
                <tr>                    
                    <th scope="col">Dia</th>
                    <th scope="col">Horario</th>
                    <th scope="col">Nome Aula</th>                
                    <th scope="col">Qtde. Vagas Disponíveis</th>                
                    <th scope="col">Ações </th>
                </tr>
            </thead>
            <tbody>

                @foreach($listaAluno as $aulainscrita)

                    <tr>        
                        <td>
                            @if(!@empty($aulainscrita->data))
                                {{date('d/m/Y', strtotime($aulainscrita->data))}}
                            @endif
                        </td>

                        <td>
                            @if(!@empty($aulainscrita->hora))
                                {{date('H:i', strtotime($aulainscrita->hora))}}
                            @endif
                        </td>

                        <td>{{$aulainscrita->nome}}</td>
                        <td>{{$aulainscrita->qtdevagasdisponiveis}}</td>

                        <td>  
                            @if($aulainscrita->inscrito == 'sim')                			                            			
                                <a href="{{route('painel.cancelarinscricao.form', $aulainscrita->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-thumbs-down"></i> Cancelar Inscrição</a>
                            @endif

                            @if($aulainscrita->inscrito == 'nao')
                                @if($aulainscrita->qtdevagasdisponiveis > 0)
                                    <a href="{{route('painel.fazerinscricao.form', $aulainscrita->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-thumbs-up"></i> Fazer Inscrição</a>
                                @else
                                    <small>Nenhuma Vaga Disponível</small>
                                @endif
                            @endif
                        </td>
                        
                    </tr> 
                         
                @endforeach

            </tbody>
	        </table> 
            
        

            <small>{{'Qtde Registros :'.count($listaAluno)}}</small>
            
        @endif     
        
        

@endsection
