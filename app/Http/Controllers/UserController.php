<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginView(){
        return view('login');
    }
    public function registerView(){
        return view('register');
    }

    public function registerPost(Request $request){
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|unique:users,email|email:dns,rfc',
            'password' => 'required|min:6|confirmed'
        ],[
            'name.required' => 'Nome obrigatório',
            'email.required' => 'Email obrigatório',
            'email.email' => 'Email inválido',
            'email.unique' => 'Email em uso',
            'password.required' => 'Senha obrigatória',
            'password.min' => 'Senha muito fraca',
            'password.confirmed' => 'As senhas não conferem',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('success', 'Usuário registrado no sistema!');
    }
    public function loginPost(Request $request){
            $request->validate([
            'email' => 'required|email:dns,rfc',
            'password' => 'required'
        ],[
            'email.required' => 'Email obrigatório',
            'email.email' => 'Email inválido',
            'password.required' => 'Senha obrigatória',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->route('pg_principal');
        }
        return redirect()->back()->with('error', 'Usuário não autenticado');
    
    }

    public function pg_principal(Request $Request){
        $user = Auth::user();
    
        if(!Auth::check()){
            return redirect()->route('loginView')->with('error', 'Você precisa estar logado para entra no site');
        }
        return view('pagina_principal', ['user' => $user]);
    }

    public function logout($id){
        $user = Auth::user();
        if($user && $user->id == $id){
            Auth::logout();
        }
        return redirect()->route('inicio');
    }

    public function logs(){
        return view('logs');
    }
    
}
