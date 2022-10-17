<?php require_once 'includes/redireccionar.php';?>
<?php require_once 'includes/conexion.php'?>
<?php require_once 'includes/helpers.php'?>

<?php

    $entrada_actual = obtenerEntrada($conexion, $_GET['entrada_id']);

    if(!isset($entrada_actual['id']))
    {
        header('Location:index.php');
    }
?>

<?php require_once 'includes/header.php';?>
<?php require_once 'includes/lateral.php';?>

<main id = "principal">
    <h1>Editar entrada <?= $entrada_actual['titulo']?></h1>

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

    <form action = "guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method = "POST">

        <label>Titulo</label>
        <input type = "text" name = "titulo" value = "<?= $entrada_actual['titulo']?>">
        <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'titulo'):"";?>

        <label>Descripción</label>
        <textarea type = "text" name = "descripcion">
            <?= $entrada_actual['descripcion']?>
        </textarea>
        <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'categoria'):"";?>

        <label>Categoria</label>
        <select name = "categoria"> 
        <?php
            $categorias = obtenerCategorias($conexion);
            if(!empty($categorias)):
            while($categoria = mysqli_fetch_assoc($categorias)):
        ?>
            <option value = "<?=$categoria['id']?>" <?= ($categoria['id']) == $entrada_actual['categoria_id'] ?'selected = "selected"' :"";?>>
            
            <?=$categoria['nombre']?></option>
        <?php 
            endwhile;
            endif;  
        ?>
        </select>
        <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'categoria'):"";?>
        <input type = "submit" value = "Actualizar">
    </form>

    <?php borrarErrores();?>
</main>







<?php require_once 'includes/footer.php';?>