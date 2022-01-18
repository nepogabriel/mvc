<?php

namespace App;

// Acessando BD
use App\core\Model;

// Classe para autenticar login
class Auth {

    // Método login, para fazer o login
    public static function login($email, $senha) {

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = Model::getConnect()->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        // Verificando se existe o email informado pelo usuário
        if( $stmt->rowCount() >= 1 ):
            // Se o e-mail estiver correto, entrará nessa condição

            // resultado da Query SELECT(retorna em array)
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            // Verificar se a senha digitada pelo usuário é igual a que está no BD
            if( password_verify($senha, $resultado['senha']) ):
                // se der tudo certo até aqui, é preciso criar a seção public/index.php 

                $_SESSION['logado'] = true;
                $_SESSION['userId'] = $resultado['id'];
                $_SESSION['userNome'] = $resultado['nome'];

                header('Location: /home/index');
            else:
                return 'Senha inválida!';
            endif;
        else:
            return 'E-mail inválido!';
        endif;
    }

    // Método logout, para deslogar
    public static function logout() {

        // Destruir sessão 
        session_destroy();
        
        header('Location: /home/login');

    }

    // Método checkLogin, para verificar se as páginas tem autorização ou se usuário tem autorização p/ algumas páginas
    public static function checkLogin() {

        // Verificando se existe um usuário logado
        if( !isset($_SESSION['logado']) ):
            header('Location: /home/login');
            die; // die — Equivalente a exit()
        endif;

    }

}