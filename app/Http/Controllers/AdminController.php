<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Checkin;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //Somente Usuários Logados Tem Acesso a Este Controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Editar o Usuário Logado
    public function showFormEditarUsuario()
    {
        return view('painel.usuario_editar');
    }
    
    public function showFormEditarUsuarioAction(Request $request)
    {
                    
       //1º Verifica se existe usuário com o e-mail Informado//
       $update = User::where('email', Auth::user()->email)->first();

       //Existe Email no cadastro ?
       if($update )
       {              

           //2º Verifica se a Senha existente no Usuário compara com a Digitada no Campo Antigo         
          if(Hash::check($request->input('password_old'),$update->password))
          {
              //3º Echo "Senha Digitada Igual a Antiga, Permite mudar a senha pegando a nova senha .<br/>";                
              
              $validacao = $request->validate([                                             
                  'password' => ['required','min:4'],                                    
              ]);
                                          
              $update->password = Hash::make($request->input('password'));
              $update->save();
                  
             //Faz Logoff e Força novo Login
             return redirect()->route('logout');
          
          }
          else
          {
              return redirect()->route('usuario.editar.form')->with(['passEdit'=>'Senha de Usuário não Confere com Antiga. Tente Novamente.']);
          }
          //
      }
      else
      {
          return redirect()->route('usuario.editar.form')->with(['passEdit'=>'E-mail de Usuário não existe em nossa base de dados.']);
      }    
       
     
  }


    //Exibe o Painel Admin Principal
    public function dashboard()
    {

        //1º
        //Caso seja Admin, Mostra Aulas Cadastradas por Ele
        $listaAdmin = Aula::where('user_id', Auth::user()->id)->paginate(30);

        //Qtde de Inscritos por Aula.
        foreach($listaAdmin as $aula)
        {
            $qtdeinscritosporaula = Checkin::where('aula_id', $aula->id)->count();                        
            $aula['qtdeinscritos'] = $qtdeinscritosporaula;            
            $aula['qtdeinscritos'] = $qtdeinscritosporaula; 
            //echo $aula->id."-".$aula->nome."- Inscritos : ".$qtdeinscritos."<br/>";
        }



        //2º

        //2.1 Pega todas as aulas disponiveis e se o aluno logado estiver inscrito nela, marca ele como inscrito.
        $AulasCadastradas = Aula::all();

        //2.2 caso Aluno logado já esteja inscrito em alguma Aula, marcar como inscrito
        foreach($AulasCadastradas as $aulacadastrada)
        {
            $InscricoesDoAlunoLogado = Checkin::where('aluno_id', Auth::user()->id)
                                        ->where('aula_id', $aulacadastrada->id)
                                        ->get();

           
            $qtdeinscritosporaula = Checkin::where('aula_id', $aulacadastrada->id)->count();                        
            $aulacadastrada['qtdeinscritos'] = $qtdeinscritosporaula;
            $aulacadastrada['qtdevagasdisponiveis'] = ($aulacadastrada->qtdemaxalunos - $qtdeinscritosporaula);

            //Caso Aluno esteja inscrito nesta Aula informar
            if (count($InscricoesDoAlunoLogado) > 0)
            {
                $aulacadastrada['inscrito'] ='sim';                               
            }
            else
            {
                $aulacadastrada['inscrito'] ='nao'; 
            }
            
        }
        

        //3º
        return view('painel.dashboard', ['listaAdmin' => $listaAdmin, 'listaAluno'=>$AulasCadastradas]);
    }


    //Abre o Form Incluir nova Aula
    public function showFormNovaAula()
    {
        return view('painel.nova_aula');
    }


    //Recupera Dados da Nova Aula e Salvar
    public function showFormNovaAulaAction(Request $request)
    {
        //dd($request);

        $validacao = $request->validate([           
            'nome' => ['required','min:3'],
            'professor' => ['required','min:4'],
            'duracao' => ['required','integer'],
            'qtdemaxalunos' => ['required','integer'],            
            'data'=>['required','date'], 
            'hora'=>['required','date_format:H:i'],
        ]);

        
        /*Antes de Inserir, Verifica se já existe aula criada para o mesmo dia e horario*/        
        $AulasEncontradasNaMesmaData = Aula::whereDate('data', '=',  $request->input('data'))->get();        

        //1-Faz um For Each nos Lancamentos encontrados e compara o Horario
        foreach($AulasEncontradasNaMesmaData as $existeData)
        {
            
            $DHInicioAulaLctoAtual = date('Y-m-d H:i:s',strtotime($request->input('data') ."".$request->input('hora')));
            $DHFimAulaLctoAtual = date('Y-m-d H:i:s',strtotime($request->input('data') ."".$request->input('hora')) + (60 * $request->input('duracao')));

            //Verifica se Encontra algum lçto na mesma sequencia de hora e valida
             $AulasMesmoHorarioData = Aula::where('dhinicioaula', '<', $DHFimAulaLctoAtual)
                                     ->where('dhfimaula','>', $DHInicioAulaLctoAtual)                                     
                                     ->get();
            
            //dd($AulasMesmoHorarioData);
            if (count($AulasMesmoHorarioData) > 0)
            {
                echo "Encontrou duplicidade";
                return redirect()->back()->withErrors(['msg' => 'Já existe aula lançada no intervalo de data e horário selecionado.'])->withInput();                
            }                                                                       
        }

        
        /* --- */
        
        $aula =  new Aula();
        $aula->nome = $request->input('nome');
        $aula->professor = $request->input('professor');
        $aula->duracao = $request->input('duracao');
        $aula->qtdemaxalunos = $request->input('qtdemaxalunos');
        $aula->hora = $request->input('hora');
        $aula->data = $request->input('data');        
        //$aula->horafim = date('H:i',strtotime($aula->hora) + (60 * $aula->duracao));        
        $aula->dhinicioaula = date('Y-m-d H:i:s',strtotime($aula->data ."".$aula->hora));
        $aula->dhfimaula = date('Y-m-d H:i:s',strtotime($aula->data ."".$aula->hora) + (60 * $aula->duracao));
        $aula->user_id = Auth::user()->id;
        $aula->save();

        return redirect()->route('painel.dashboard');

    }

    //Recupera o ID, carrega a Aula e Preenche o Form para editar
    public function showFormEditaAula($id)
    {
        $aulaselecionada = Aula::where('id', $id)->where('user_id', Auth::user()->id)->first();
       
        if($aulaselecionada)
        {
            //Existe Aula Abre Form preenchido
            return view('painel.editar_aula', ['aula'=>$aulaselecionada]);
        }
        else
        {
            return redirect()->route('painel.dashboard')->with(['ErrorDashboard'=>'Aula selecionada não existe.']);
        }
        
    }


    //Recupera os Dados dos Alunos Inscritos na Aula Selecioanda
    public function showFormAlunosInscritosAula($idAula)
    {

         //1-Recupera Dados da Aula Selecionada
         $aula = Aula::where('id', $idAula)->first();

         //dd($aula);
 
         if($aula)
         {                                 
                //2-Recupera os Alunos Inscritos na Aula
                $Inscritos = Checkin::where('aula_id', $aula->id)->get();

                //3-Adiciona os dados do Aluno,como nome, id e etc as Aulas Inscritas
                foreach($Inscritos as $aluno)
                {
                    $aluno['aluno'] = User::where('id', $aluno->aluno_id)->first();
                }

                return view('painel.alunosinscritos_aula', ['inscritos'=>$Inscritos]);
        }
        else
        {
            return redirect()->route('painel.dashboard')->with(['ErrorDashboard'=>'Aula selecionada não existe.']);   
        }

            
        
    }

    //Recupera os dados do form de edicao da aula e salva no database
    public function showFormEditaAulaAction($id, Request $request)
    {
        //dd($request);
        $aula = Aula::where('id', $id)->where('user_id', Auth::user()->id)->first();

        //dd($aula);

        if($aula)
        {
            
            $validacao = $request->validate([           
                'nome' => ['required','min:3'],
                'professor' => ['required','min:4'],
                'duracao' => ['required','integer'],
                'qtdemaxalunos' => ['required','integer'],            
                'data'=>['required','date'], 
                'hora'=>['required','date_format:H:i'],
            ]);
            
            
            /*Antes de Inserir, Verifica se já existe aula criada para o mesmo dia e horario*/        
            $AulasEncontradasNaMesmaData = Aula::whereDate('data', '=',  $request->input('data'))->get();        

            //1-Faz um For Each nos Lancamentos encontrados e compara o Horario
            foreach($AulasEncontradasNaMesmaData as $existeData)
            {
                
                $DHInicioAulaLctoAtual = date('Y-m-d H:i:s',strtotime($request->input('data') ."".$request->input('hora')));
                $DHFimAulaLctoAtual = date('Y-m-d H:i:s',strtotime($request->input('data') ."".$request->input('hora')) + (60 * $request->input('duracao')));

                //Verifica se Encontra algum lçto na mesma sequencia de hora e valida
                $AulasMesmoHorarioData = Aula::where('dhinicioaula', '<', $DHFimAulaLctoAtual)
                                        ->where('dhfimaula','>', $DHInicioAulaLctoAtual)                                     
                                        ->get();
                
                //dd($AulasMesmoHorarioData);
                if (count($AulasMesmoHorarioData) > 0)
                {
                    //echo "Encontrou duplicidade";
                    return redirect()->back()->withErrors(['msg' => 'Já existe aula lançada no intervalo de data e horário selecionado.'])->withInput();                
                }                                                                       
            }

            
            /* --- */
            
            
            //Existe Aula então edita      
            $aula->nome = $request->input('nome');
            $aula->professor = $request->input('professor');
            $aula->duracao = $request->input('duracao');
            $aula->qtdemaxalunos = $request->input('qtdemaxalunos');
            $aula->hora = $request->input('hora');
            $aula->data = $request->input('data');
            //$aula->horafim = date('H:i',strtotime($aula->hora) + (60 * $aula->duracao));
            $aula->dhinicioaula = date('Y-m-d H:i:s',strtotime($aula->data ."".$aula->hora));
            $aula->dhfimaula = date('Y-m-d H:i:s',strtotime($aula->data ."".$aula->hora) + (60 * $aula->duracao));
            $aula->user_id = Auth::user()->id;
            $aula->save();

            return redirect()->route('painel.dashboard');
        }
        else
        {
            return redirect()->route('painel.dashboard')->with(['ErrorDashboard'=>'Aula selecionada não existe.']);
        }

    }


    //Remover Aula, e depois setar nos usuarios inscritos que aula foi apagada
    public function showRemoverAulaAction($id)
    {
        //Encontrou Aula existente para o usuario logado.
        $aula = Aula::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if($aula)
        {

            //1º Pega dados de Todos os Alunos Inscritos
            $alunosEnviarEmail = array();
            $inscritos = Checkin::where('aula_id', $aula->id)->get();


            //2 º Faz Varredura e Pega o Nome e Email dos Usuarios para Enviar o Email,
            //informando que Aula foi Cancelada
            foreach($inscritos as $inscrito)
            {
                $dadosAluno = User::where('id', $inscrito->aluno_id)->first();
                $alunosEnviarEmail[] = ['Aluno'=> $dadosAluno->name, 'email'=>$dadosAluno->email];                            
            }
        

            //3º Existe checkin neste aula, apaga todos os alunos inscritos            
            if($inscritos)
            {                
                foreach($inscritos as $inscrito)
                {
                    $inscrito->delete();
                }                
            }

            //4º Encontrou a Aula Remove
            $aula->delete();


            //5º Enviar o Email para os Alunos
            //Metodo Enviar Email.....

            alert()->warning('Atenção','Disparar Email para Alunos que estão no Array');


            //6-Recarrega Listagem
            return redirect()->route('painel.dashboard');
        }
        else
        {
            return redirect()->route('painel.dashboard')->with(['ErrorDashboard'=>'Aula selecionada não existe.']);
        }
    }



    //Cancelar Inscrição do Aluno na Aula
    public function showCancelarInscricaoAula($idAula)
    {              
        $estainscrito = Checkin::where('aula_id', $idAula)->where('aluno_id', Auth::user()->id)->first();

        if($estainscrito)
        {


            //O Aluno pode cancelar o checkin até 30 minutos antes da aula
             $AulaInscrita = Aula::where('id', $idAula)->first();
            //if ($AulaInscrita->dhinicioaula <> Date())

            //$start = date_create('2021-12-24 18:55:00');
            //$end = date_create('2021-12-24 18:39:24');
            //$diff=date_diff($end,$start);
            //dd($diff);

            $dhDiaAtual = date_create(date('m/d/Y h:i:s a', time()));
            $dhInicioAula = date_create($AulaInscrita->dhinicioaula);
            $diff=date_diff($dhInicioAula,$dhDiaAtual);


            $horaDiferenca = $diff->format('%h');
            $minutosDiferenca = $diff->format('%I');
            
            //Esta tentando cancelar no mesmo dia, dentro de um periodo de 59 minutos antes da Aula
            if (($horaDiferenca === '0' || $horaDiferenca ==='00') ||
               ($horaDiferenca === 0 || $horaDiferenca ===00))
            {                
                if ($minutosDiferenca < 30)
                {
                    //echo "Não é Possível Cancelar Inscrição das Aula, Já Irá começar nos proximos 30 minutos";
                    alert()->error('Atenção','Só é possível cancelar a inscrição até 30 minutos antes da aula. Operação não realizada');
                    return redirect()->route('painel.dashboard')->with(['ErrorDashboard'=>'Não é possível cancelar a inscrição, aula já irá iniciar..']);
                }


            }

            
            //1º Encontrou Inscrição Remove
            $estainscrito->delete();

            //2-Envia para Listagem do Usuario Logado
            return redirect()->route('painel.dashboard');
        }
        else
        {
            return redirect()->route('painel.dashboard')->with(['ErrorDashboard'=>'Aula não está com inscrição por este Aluno.']);
        }
    }

    //Fazer Inscrição do Aluno na Aula
    public function showFazerInscricaoAula($idAula)
    {        
        
        
        //Existe a Aula
        $aula = Aula::where('id', $idAula)->first();

        if($aula)
        {

            $checkin = new Checkin();
            $checkin->aluno_id = Auth::user()->id;
            $checkin->aula_id = $idAula;
            $checkin->save();
            
            alert()->success('Atenção','Sua inscrição foi realizada com sucesso');
            return redirect()->route('painel.dashboard');
        }
        else
        {
            return redirect()->route('painel.dashboard')->with(['ErrorDashboard'=>'Aula selecionada não existe.']);
        }

    }


}
