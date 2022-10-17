<?php

    if(!isset($_POST['busqueda']))
    {
        header('Location:index.php');
    }
?>

<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/lateral.php'?>


<main id = "principal">

    <h1>Busqueda: <?=$_POST['busqueda']?></h1>

    <?php
        $entradas = obtenerEntradas($conexion, null , null, $_POST['busqueda']);

        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>

    <article class = "articulo">
        <a href = "entrada.php?id=<?=$entrada['id']?>"> 
            <h2><?=$entrada['titulo']?></h2>
            <span class = "fecha"><?=$entrada['nombre']." | ".$entrada['fecha']?></span>
            <p><?=$entrada['descripcion'] ?></p>
        </a>
    </article>

    <?php
            endwhile;
        else:
    ?>
        <div class = "alerta">
            No hay entradas para esta categoria
        </div>
    <?php
        endif;
    ?>
</main>

<?php require_once 'includes/footer.php'?>