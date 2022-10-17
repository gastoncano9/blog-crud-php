<?php require_once 'includes/header.php' ?>
       
<!--barra-->
<?php require_once 'includes/lateral.php'?>

<!--main-->

<main id = "principal">
    <h1>Todas las entradas</h1>

    <?php
        $entradas = obtenerEntradas($conexion, null);

        if(!empty($entradas)):
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
        endif;
    ?>
</main>

<?php require_once 'includes/footer.php'?>