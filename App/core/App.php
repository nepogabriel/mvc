<?php

namespace App\core;

// Sistemas de rotas
class App {
    
    // Atributos para definir o controller padrão (se não tiver nenhum parâmetro na URL, o padrão será home) 
    protected $controller = 'home';
    protected $method = 'index';
    protected $parameter = []; // os parâmetros serão um array, por isso um array vazio como padrão

    public function __construct() {
        $url = $this->parseURL(); // atribuindo o método parseURL() dentro da váriavel $url
        //print_r($url = $this->parseURL()); // Para visualizar o array $url

        // Verificando se existe um controller com o mesmo nome do indice 1 da url
        if( file_exists('../App/controllers/'.$url[1].'.php') ):
            $this->controller = $url[1]; // atribuindo nome que está no indice 1 da url ao controller
            unset($url[1]); // Limpando os parâmetros antes do indice 3, para não dar erro nas rotas
        endif;

        // chamando o controller atualizado (arquivo referente ao 1 parâmetro da url)
        require_once '../App/controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller; // Atributo controller agora é um objeto(class)

        // Verificando de existe o parâmetro 2 da url
        if( isset($url[2]) ):
            /* -Verificando se existe o método(function) dentro do Objeto(controller/class), o parametro 2 da url é o nome do método.
            -1. nome do objeto(controller/class), 2. nome do método(function) */
            if( method_exists($this->controller, $url[2]) ):
                $this->method = $url[2]; // atribuindo nome que está no indice 2 da url ao método
                // Limpando os parâmetros antes do indice 3, para não dar erro nas rotas
                unset($url[2]);
                unset($url[0]);
            endif;
        endif;

        /*
        Utilizando operador ternario(IF, ELSE) para escrever menos 
        Abreviação de:
        if($this->parameter = $url) {
            array_values($url)
        } else {
            [];
        }

        Se a URL tiver valores(parâmetros) irá atribuir ao atributo $this->parameter, caso não exista ele continuará vazio
        */
        $this->parameter = $url ? array_values($url) : [];

        /* Executando método que está dentro do controller p/ acessar url
        -1.controller, 2.método, 3.parâmetros*/
        call_user_func_array([$this->controller, $this->method], $this->parameter); // call_user_func_array — Chama uma dada função de usuário com um array de parâmetros

    }

    // Esse método é para pegar a URL
    public function parseURL() {
        // explode - transforma uma string em um array, use o '/' para separar o array
        //$_SERVER['SERVER_NAME'] - nome do host, $_SERVER['REQUEST_URI'] - página atual
        // filter_var — Filtra a variável com um especificado filtro / FILTER_SANITIZE_URL - Remova todos os caracteres, exceto letras, dígitos e $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=
        return explode('/', filter_var($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));
    }

    // Pegar a url que está sendo acessada no momento
    public function currentURL() {
        // Pegando url
        $url = $this->parseURL();

        // Se o indice 1 estiver vazio e o indice 2 não existir
        if( $url[1] == '' && !isset($url[2]) ) {
            $url[1] = 'home';
            $url[2] = 'index';
        }

        // Esse método é uma forma de não deixar a url vázia
        return URL_BASE . $url[1] . '/' . $url[2] . '/';

    }
}