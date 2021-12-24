<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //


    //FormLogin
    public function showFormLogin()
    {
        return view('autenticacao.usuario_login');
    }

    //FormLogin, recupera dados do form e Faz Login se existir usuario
    public function showFormLoginAction(Request $request)
    {
        //dd($request);

        //Email invalido, redireciona para preencher novamente
        if(!filter_var($request->input('email')  ,FILTER_VALIDATE_EMAIL)){
            return redirect()->route('login')->with(['loginError'=>'E-mail Inválido.']);
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) 
        {                       
            //Autenticou com sucesso Redireciona para Dashboard
            return redirect()->route('painel.dashboard');
        }


        alert()->error('Atenção','Usuário ou senha Inválido');
        return redirect()->route('login')->with(['loginError'=>'Usuário ou senha Inválido.']);
    }


    public function showFormNovoUsuario()
    {
        return view('autenticacao.usuario_novo');
    }

    //Recupera dados do usuário e faz cadastro se não existir
    public function showFormNovoUsuarioAction(Request $request)
    {
        //Email invalido, redireciona para preencher novamente
        if(!filter_var($request->input('email')  ,FILTER_VALIDATE_EMAIL)){
            return redirect()->route('login.novo.usuario')->with(['loginError'=>'E-mail Inválido.']);
        }

        
        $JaTemCadastro = User::where('email', $request->input('email'))->count();

        if($JaTemCadastro === 0 )
        {
            $validacao = $request->validate([           
                'email' => ['required','email','unique:users,email'],
                'name' => ['required','min:4'],
                'tipocadastro'=>['required','min:2'],
                'password' => ['required','min:4','confirmed'],
            ]);
            
            //Se passou pela Validação ele Continua o Cadastro//

            $user = new User();
            $user->name = $request->input('name') ;
            $user->email = $request->input('email');
            $user->tipocadastro = $request->input('tipocadastro');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('login')->with(['loginInfo'=>'Usuário cadastrado. Faça Login']);

        }
        else
        {
            
            alert()->error('Atenção','E-mail informado já possui cadastro.');
            return redirect()->route('login.novo.usuario')->with(['loginError'=>'E-mail informado já possui cadastro.']);
        }   
    }


    //Só faz logoff se estiver Logado
    public function logout()
    {                
        if (Auth::check()) 
        {
            Auth::logout();
        }

        return redirect()->route('login');        
    }
}
