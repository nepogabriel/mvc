<h2> Editar bloco de anotação </h2>

<?php
// empty — Determina se a variável é vazia
if( !empty($data['mensagem']) ):
    foreach($data['mensagem'] as $msg):
        echo $msg . '<br>';
    endforeach;
endif;
?>

<!-- caminho de action é o mesmo que está na view -->
<form action="/notes/editar/<?= $data['registros']['id']; ?>" method="POST">
    Titulo: <input type="text" name="titulo" value="<?= $data['registros']['titulo']; ?>"> <br>
    Texto: <textarea name="texto"> <?= $data['registros']['texto']; ?> </textarea> <br>
    <button type="submit" name="atualizar"> Atualizar </button>
</form>