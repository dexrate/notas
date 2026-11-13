<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        //form validação
        $request->validate(
            [
                'text_username' => ['required', 'email'],
                'text_password' => ['required', 'min:6', 'max:20']
            ],
            [   
                'text_username.required' => 'O campo de usuário é obrigatório.',
                'text_username.email' => 'O campo de usuário deve ser um endereço de e-mail válido.',
                'text_password.required' => 'O campo de senha é obrigatório.',
                'text_password.min' => 'A senha deve ter pelo menos :min caracteres.',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres'
            ]
        );

        //get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');
        
        //teste bd
        try {
            DB::connection()->getPdo();
            echo "Conexão com o banco de dados estabelecida com sucesso.";
        } catch (\PDOException $e) {
            echo "Erro ao acessar o banco de dados: " . $e->getMessage();
            // return redirect()->back()->withErrors(['database' => 'Erro ao acessar o banco de dados.']);
        }
    }

    public function logout()
    {
        echo "logout";
    }
}
