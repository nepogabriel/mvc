<?php

namespace App\core;

// Classe responsavel por fazer a CONEXÃO com BANDO DE DADOS
//Padrão Singleton - única instancia
class Model {

    private static $instance;

    public static function getConnect() {

        if( !isset(self::$instance) ):
            self::$instance = new \PDO('mysql:host=localhost;dbname=mvc;charset=utf8', 'root', '12345');
        endif;

        return self::$instance;

    }
}