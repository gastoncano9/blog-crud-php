<?php

    require_once 'includes/redireccionar.php';

    require_once 'includes/header.php';
        
    require_once 'includes/lateral.php';
?>

<main id = "principal">
    <h1>Crear categorias</h1>

    <?php if(isset($_SESSION['completado'])):?>
        <div class = "alerta">
            <?= $_SESSION['completado'];?>
        </div>
    <?php elseif(isset($_SESSION['errores']['error-categoria'])):?>
        <div class = "alerta alerta-error">
            <?= $_SESSION['errores']['error-categoria'];?>
        </div>
    <?php borrarErrores();?>
    <?php endif;?>
    <form action = "guardar-categoria.php" method = "POST"> 
        <label>Nombre</label>
        <input type = "text" name = "nombre">
        <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'nombre'):"";?>
        <input type = "submit" value = "Crear">
    </form>
    <?php borrarErrores();?>
</main>

<?php require_once 'includes/footer.php'?>

