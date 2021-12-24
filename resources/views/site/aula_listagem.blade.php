@extends('site.base')
@section('content')


<div class="alert alert-success" role="alert">
  Acesse o Painel Administrativo e Gerencie as Aulas. <a href="{{route('login')}}" class="alert-link">Clique Aqui</a>
</div>

<hr/>
<h3>Teste de Conhecimento em PHP/Laravel</h3>
<p>Módulo : Gestão de Aulas por professores, criação das aulas.</p>
<p>Módulo : para realização de Checkin/Inscrição em Aula por alunos.</p>

<div class="alert alert-success" role="alert">
  Como Usar a Aplicação
</div>

<p>Existe o Cadastro de um Usuário Administrador :<br/>
  Responsável por Cadastrar, Editar as Aulas, Ver Alunos Inscritos e etc.<br/>
  Email : admin@hotmail.com e Senha: 123456
</p>

<p>Existe o Cadastro de dois Alunos :<br/>
  Que irão ter acesso as Aulas Cadastradas, se inscrever, desfazer inscrição e etc.<br/>
  Email : aluno1@hotmail.com e Senha: 123456<br/>
  Email : aluno2@hotmail.com e Senha: 123456
</p>


<img class="mb-4" src="{{asset('img/teacher.png')}}" alt="Imagem Professor" width="250" height="120">


@endsection