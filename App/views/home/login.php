<?php
if( !empty($data['mensagem']) ):
    foreach( $data['mensagem'] as $msg ):
        echo $msg;
    endforeach;
endif;
?>

<div class="row container">
    <h1 class="titleLogin"> Fazer Login </h1>

    <form action="/home/login" method="POST"> 
        E-mail: <input type="text" name="email"> <br>
        Senha: <input type="password" name="senha"> <br>
        <button type="submit" name="btn-login" class="waves-effect waves-light btn-small purple"> Entrar </button>
    <form>
</div>