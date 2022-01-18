<nav>
    <div class="nav-wrapper">
        <form action="/home/buscar" method="POST">
            <div class="input-field">
            <input id="search" type="search" name="buscar" required>
            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
            <i class="material-icons">close</i>
            </div>
        </form>
    </div>
</nav>

<?php 
if( !empty( $data['mensagem'] ) ):
    foreach( $data['mensagem'] as $msg ):
        echo $msg . '<br>';
    endforeach;
endif;
?>

<div class="row container">
    
    <?php
        // Os parametros seguem está ordem: __construct($dados, $atual, $quantidade)
        $pagination = new App\Pagination($data['registros'], isset($_GET['page']) ? $_GET['page'] : 1, 2 );

    ?>
    
    <?php
        // Verificando se o array veio vázio
        if( empty($pagination->resultado()) ) {
            echo 'Nenhum registro encontrado!';
        }

    ?>

    <?php
    // Exibindo dados da consulta SELECT em models/Note.php
    foreach(/*$data['registros']*/ $pagination->resultado() as $note):
    ?>

        <h2> <a href="/notes/ver/<?php echo $note['id'] ?>"> <?php echo $note['titulo']; ?> </a> </h2>
        <p> <?php echo $note['texto']; ?> </p>

        <?php if( isset($_SESSION['logado'])): ?>
            <!-- para editar e exluir um dado precisa do iD -->
            <a class="waves-effect waves-light btn orage" href="/notes/editar/<?php echo $note['id'] ?>"> Editar Post </a> | 
            <a class="waves-effect waves-light btn red" href="/notes/exluir/<?php echo $note['id'] ?>"> Excluir Post </a>
        <?php endif; ?>

    <?php endforeach; ?>

    <?php
        // Navegação
        $pagination->navigator();
    ?>

</div>