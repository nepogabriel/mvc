<?php

namespace App;
use App\Core\App;

class Pagination extends App {

    public $dados; // Todos os registros vindo do BD
    public $atual; // Pág. atual
    public $quantidade; // Total de registros por pág.
    public $registrosPagina; // Super array com todos os dados
    public $contar; // Loop de acordo com a qntd. de registros, para saber quantas págs vai ter
    public $resultado;

    public function __construct($dados, $atual, $quantidade) {
        $this->dados = $dados;
        $this->atual = $atual;
        $this->quantidade = $quantidade;
    }

    public function resultado() {
        // dividir um array em pedaços array_chunk(1-o array, 2- quantidade de pedaços)
        $this->registrosPagina = array_chunk($this->dados, $this->quantidade);

        // Quantidade total de registros
        $this->contar = count($this->registrosPagina);

        // Trazendo o resultado
        if($this->contar > 0) {
            $this->resultado = $this->registrosPagina[$this->atual-1];
    
            return $this->resultado;
        } else {
            return [];
        }
        
    }

    // Navegação
    public function navigator() {
        // Vai retornar um HTML com Loop p/ contar os registros

        echo "<ul class='pagination'>";

            for( $i = 1; $i <= $this->contar; $i++ ) {
                if( $i == $this->atual ){
                    echo "<li class='active'> <a href='#'>" . $i . "</a> </li>";
                } else {
                    echo "<li> <a href='" . $this->currentURL() . "?page=" . $i . "'>" . $i . " </a> </li>";
                }
            }

        echo "</ul>";
    }

}