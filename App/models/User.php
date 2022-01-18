<?php

use \App\core\Model;

class User extends Model {
    
    public $nome;
    public $email;
    public $senha;

    public function saveUser() {

        $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";

        $stmt = Model::getConnect()->prepare($sql);
        $stmt->bindValue(1, $this->nome);
        $stmt->bindValue(2, $this->email);
        $stmt->bindValue(3, $this->senha);

        if( $stmt->execute() ):
            return 'Cadastrado com sucesso!';
        else:
            return 'Erro ao cadastrar!';
        endif;
    }

}
