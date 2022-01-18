<h2> Criar bloco de anotação </h2>

<?php
//var_dump($data)

// empty — Determina se a variável é vazia
if( !empty($data['mensagem']) ):
    foreach($data['mensagem'] as $msg):
        echo $msg . '<br>';
    endforeach;
endif;
?>

<form action="" method="POST" enctype="multipart/form-data">
    Titulo: <input type="text" name="titulo"> <br>
    Texto: <textarea name="texto"></textarea> <br>
    Imagem: <input type="file" name="foo" value=""/> <br><br>
    <button type="submit" name="cadastrar"> Cadastrar </button>
</form>