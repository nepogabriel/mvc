<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso MVC</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="<?php echo URL_BASE;?>/css/style.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
    <!-- Esse arquivo é o HTML base -->
    <!-- Esse template irá carregar a view -->


    <!-- LOGO
    <img src="<?php //echo URL_BASE; ?>/images/logo_cliente.jpg">
    -->

    <!-- MENU -->
    <nav class="blue">
        <div class="nav-wrapper container">
            <a href="/" class="brand-logo">Bloco de Anotações</a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li> <a href="/"> Posts </a> </li>
            
                <!-- Verificando se existe um usuário logado -->
                <?php if( isset($_SESSION['logado'])): ?>

                    <li> <a href="/notes/criar"> Criar bloco </a> </li>
                    <li> <a href="/users/cadastrar"> Cadastrar Usuário </a> </li>
                    <li> <a href="/home/logout"> Logout </a> </li>

                <?php else: ?>

                    <li> <a href="/home/login"> Login </a>  </li>
                
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Inserindo a view dentro do template -->
    <?php require_once '../App/views/' . $views . '.php'; ?>
    
</body>
</html>