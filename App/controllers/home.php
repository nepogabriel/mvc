<?php

use \App\core\Controller;
use App\Auth;

// Controller Home, indice 1 da url
class Home extends Controller {

    // Método padrão definido nos atributos do arquivo App/core/App.php
    public function index() {

        $note = $this->model('Note'); // instanciando model / Note é o nome do model

        // Resultado do select no BD
        $dados = $note->getAll();

        // Chamando view
        // 1-nome da views(caminho da view), 2-array(preenchido pela consulta SELECT)
        $this->views('home/index', $dados = ['registros' => $dados]);
    }

    // Método para campo de busca
    public function buscar() {

        $busca = isset($_POST['buscar']) ? $_POST['buscar'] : $_SESSION['buscar'];
        $_SESSION['buscar'] = $busca;

        $note = $this->model('Note');
        $dados = $note->buscar($busca);

        $this->views('home/index', $dados = ['registros' => $dados]);

    }


    public function login() {

        $mensagem = array();

        if( isset($_POST['btn-login']) ):

            // Verificando se o campo email ou senha está vazio
            if( (empty($_POST['email'])) or (empty($_POST['senha'])) ):
                $mensagem[] = 'O campo e-mail e senha são obrigatórios!';
            else:
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                // executando método login($email, $senha) e passando os parâmetros
                $mensagem[] = Auth::login($email, $senha); // $mensagem[], pois pode ter um retorno
            endif;

        endif;

        $this->views('home/login', $dados = ['mensagem' => $mensagem]);
    }

    public function logout() {
        // Intanciando método logoout
        Auth::logout();
    }

}