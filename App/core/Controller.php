<?php

namespace App\core;

// Controller base - todos os controllers irão herdar os atributos e métodos do controller Base
class Controller {

    // Parâmetro $model é o nome do model
    public function model($model) {
        // quando o método for instanciado irá carregar o model
        require_once '../App/models/' . $model . '.php';
        return new $model;
    }

    // 1-nome da views(caminho da view), 2-array(p/ dados dinâmicos)
    public function views($views, $data = []) {
        // chamando o template, pois a view será chamada dentro do template
        require_once '../App/views/template.php';
    }

}