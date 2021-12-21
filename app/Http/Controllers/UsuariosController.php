<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id', 'asc')->get();

        return view('usuarios.index', ['usuarios' => $usuarios, 'pagina' => 'usuarios']);
    }

    public function create()
    {
        return view('usuarios.create', ['pagina' => 'usuarios']);
    }

    public function insert(Request $form)
    {
        $usuario = new Usuario();

        $usuario->name = $form->name;
        $usuario->email = $form->email;
        $usuario->username = $form->username;
        $usuario->password = Hash::make($form->password);

        $usuario->save();
        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect()->route('verification.notice');
    }

    // Ações de login
    public function login(Request $form)
    {
        // Está enviando o formulário
        if ($form->isMethod('POST'))
        {
            // $usuario = $form->username;
            // $senha = $form->password;

            // $consulta = Usuario::select('id', 'name', 'email', 'username', 'password')->where('username', $usuario)->get();

            // // Confere se encontrou algum usuário
            // if ($consulta->count())
            // {
            //     // Confere se a senha está correta
            //     if (Hash::check($senha, $consulta[0]->password))
            //     {
            //         unset($consulta[0]->password);

            //         session()->put('username', $consulta[0]);

            //         return redirect()->route('home');
            //     }
            // }

            // Login deu errado (usuário ou senha inválidos)

            // return redirect()->route('login')->with('erro', 'Usuário ou senha inválidos.');

            $credenciais = $form->validate([
                'username' => ['required'],
                'password' => ['required']
            ]);

            $remember = $form->remember;

            if(Auth::attempt($credenciais, $remember)){
                session()->regenerate();
                return redirect()->route('home');
            }else{
                return redirect()->route('login')->with('erro', 'Usuário ou senha inválidos.');
            }
        }

        return view('usuarios.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function profile(){
        return view('usuarios.perfil', ['pagina' => 'usuarios']);
    }

    public function edit(){
        return view('usuarios.edit', ['pagina' => 'usuarios']);
    }

    public function alterar(Request $form){
        $usuario = Usuario::where('id', Auth::user()->id)->first();

        $validate = $form->validate([
            'name' => ['required'],
            'email' => ['required']
        ]);

        $usuario->name = $form->name;
        if($usuario->email != $form->email){
            $usuario->email = $form->email;
            $usuario->email_verified_at = null;
            $usuario->sendEmailVerificationNotification();
        }

        $usuario->save();

        return redirect()->route('usuarios.perfil');
    }

    public function password(){
        return view('usuarios.password', ['pagina' => 'usuarios']);
    }

    public function senha(Request $form){
        $usuario = Usuario::where('id', Auth::user()->id)->first();

        $validate = $form->validate([
            'verifica' => ['required'],
            'password' => ['required'],
            'confirmaPassword' => ['required']
        ]);

        if(Hash::check($form->verifica, $usuario->password) && $form->password == $form->confirmaPassword){
            $usuario->password = Hash::make($form->password);

            $usuario->save();

            return redirect()->route('usuarios.perfil');
        }else{
            return redirect()->route('home');
        }

    }
}
