<?php
session_start();

require '../vendor/autoload.php';

// Para chamar arquivos do public dentro da pasta App é preciso definir uma cosntante com URL_BASE
define("URL_BASE", "http://localhost:8888/");

$app = new \App\core\App();