<?php

use \App\core\Controller;
use App\Auth;

class Users extends Controller {

    public function index() {
        //header('Location: /home/index');

        Auth::checkLogin();

        echo 'Lista de usuários.';
    }

    public function cadastrar() {
        // Verificando se usuário permissão p/ acessar páginas restristas
        Auth::checkLogin();

        $mensagem = [];

        if( isset($_POST['cadastrar-user']) ):
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $user = $this->model('User');
            // Passando $_POST para os atributos o models Class User
            $user->nome = $nome;
            $user->email = $email;
            $user->senha = $senha;

            $mensagem[] = $user->saveUser();

        endif;

        $this->views('users/cadastrar', $dados = ['mensagem' => $mensagem]);

    }

}