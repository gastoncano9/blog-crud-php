<?php require_once 'includes/conexion.php'?>
<?php require_once 'includes/helpers.php'?>

<?php

    $entrada_actual = obtenerEntrada($conexion, $_GET['id']);

    if(!isset($entrada_actual['id']))
    {
        header('Location:index.php');
    }
?>

<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/lateral.php'?>


<main id = "principal">

    <h1><?= $entrada_actual['titulo']?></h1>
    <a href = "categoria.php?id=<?=$entrada_actual['categoria_id']?>">
        <h2><?= $entrada_actual['nombre']?></h2>
    </a>
    <h4><?= $entrada_actual['fecha']?> | <?=$entrada_actual['usuario']?></h4>
    <p>
        <?= $entrada_actual['descripcion']?>
    </p>

    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']):?>
        <a class = "boton boton-verde" href = "editar-entrada.php?entrada_id=<?=$entrada_actual['id']?>">Editar entrada</a>
        <a class = "boton" href = "eliminar-entrada.php?entrada_id=<?=$entrada_actual['id']?>">Eliminar entrada</a>
    <?php endif;?>
</main>

<?php require_once 'includes/footer.php'?>