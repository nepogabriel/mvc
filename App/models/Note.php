<?php

use \App\core\Model;

class Note extends Model {

    // Campos da tabela notes, utilizando no método saveCriar()
    public $titulo;
    public $texto;

    // Método que irá listas todos os dados do BD
    public function getAll() {

        $sql = "SELECT * FROM notes";
        $select = Model::getConnect()->prepare($sql);
        $select->execute();

        // Verificando se existe algum registro na tabela
        if( $select->rowCount() > 0 ):
            // fetchAll pq o select irá obter todas as linhas e campos da tabela
            $resultado = $select->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            // Irá retornar um array vázio caso não encontre nenhum registro
            return [];
        endif;
    }

    // Pegando ID para abrir o artigo clicado
    public function findId($id) {

        $sql = "SELECT * FROM notes WHERE id = ?";
        $select = Model::getConnect()->prepare($sql);
        /* bindValue: Vincula um valor a um marcador de posição nomeado ou de ponto de interrogação correspondente
        na instrução SQL que foi usada para preparar a instrução. */
        $select->bindValue(1, $id);
        $select->execute();

        // Verificando se existe algum registro
        if( $select->rowCount() > 0 ):
            $resultado = $select->fetch(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            return [];
        endif;

    }

    // Salvando no BD os valores do form de criação do bloco de anotações
    public function saveCriar() {

        //Tirar dúvida pq com o nome da tabela errada dar erro e não exibe mensagem de 'Erro ao cadastrar'
        // $sql = "INSERT INTO notexs (titulo, texto) VALUES (?, ?)";

        $sql = "INSERT INTO notes (titulo, texto) VALUES (?, ?)";

        $stmt = Model::getConnect()->prepare($sql);
        $stmt->bindValue(1, $this->titulo);
        $stmt->bindValue(2, $this->texto);
        
        if( $stmt->execute() ):
            return 'Cadastrado com sucesso!';
        else:
            return 'Erro ao cadastrar!';
        endif;

    }

    public function update($id){

        $sql = "UPDATE notes SET titulo = ?, texto = ? WHERE id = ?";

        $stmt = Model::getConnect()->prepare($sql);
        $stmt->bindValue(1, $this->titulo);
        $stmt->bindValue(2, $this->texto);
        $stmt->bindValue(3, $id);

        if( $stmt->execute() ):
            return 'Atualizado com sucesso!';
        else:
            return 'Erro ao atualizar.';
        endif;

    }

    public function delete($id) {

        $sql = "DELETE FROM notes WHERE id = ?";

        $stmt = Model::getConnect()->prepare($sql);
        $stmt->bindValue(1, $id);

        if( $stmt->execute() ):
            return 'Post excluído com sucesso!';
        else:
            return 'Erro ao excluir post.';
        endif;

    }

    // Método para campo de busca
    public function buscar($busca) {

        $sql = "SELECT * FROM notes WHERE titulo LIKE ? COLLATE utf8_general_ci";
        
        $stmt = Model::getConnect()->prepare($sql);
        // LIKE e bindValue trabalha dessa forma
        $stmt->bindValue(1, "%{$busca}%");
        $stmt->execute();

        if( $stmt->rowCount() > 0 ):
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            return [];
        endif;

    }

}