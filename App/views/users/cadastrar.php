<h2> Cadastrar Usuário </h2>

<?php
//var_dump($data)

// empty — Determina se a variável é vazia
if( !empty($data['mensagem']) ):
    foreach($data['mensagem'] as $msg):
        echo $msg . '<br>';
    endforeach;
endif;
?>

<form action="" method="POST">
    Nome: <input type="text" name="nome"> <br>
    E-mail: <input type="text" name="email"> <br>
    Senha: <input type="password" name="senha"> <br>
    <button type="submit" name="cadastrar-user"> Cadastrar </button>
</form>