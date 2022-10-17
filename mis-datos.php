<?php
    require_once 'includes/redireccionar.php';

    require_once 'includes/header.php';
        
    require_once 'includes/lateral.php';
?>

<main id = "principal">
    <h1>Actualizar datos</h1>
    
    <div class = "bloque">
        <?php if(isset($_SESSION['completado'])):?>
            <div class = "alerta">
                <?= $_SESSION['completado'];?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])):?>
            <div class = "alerta alerta-error">
                <?= $_SESSION['errores']['general'];?>
            </div>
            <?php borrarErrores();?>
        <?php endif;?>

        <form action = "actualizar-datos.php" method = "POST">

            <label for = "nombre">Nombre</label>
            <input type = "text" name = "nombre" value = "<?=$_SESSION['usuario']['nombre']?>">

            <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'nombre'):"";?>

            <label for = "apellido">Apellido</label>
            <input type = "text" name = "apellido" value = "<?=$_SESSION['usuario']['apellido']?>">

            <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'apellido'):"";?>

            <label for = "email">Email</label>
            <input type = "email" name = "email" value = "<?=$_SESSION['usuario']['email']?>">

            <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'email'):"";?>

            <input type = "submit" value = "Actualizar">
        </form>
        <?php borrarErrores();?>
    </div>
    
</main>

<?php require_once 'includes/footer.php'?>