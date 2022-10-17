<?php

    require_once 'includes/redireccionar.php';

    require_once 'includes/header.php';
        
    require_once 'includes/lateral.php';
?>

<main id = "principal">
    <h1>Crear entradas</h1>

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

    <form action = "guardar-entrada.php" method = "POST">

        <label>Titulo</label>
        <input type = "text" name = "titulo">
        <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'titulo'):"";?>

        <label>Descripción</label>
        <textarea type = "text" name = "descripcion"></textarea>
        <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'categoria'):"";?>

        <label>Categoria</label>
        <select name = "categoria"> 
        <?php
            $categorias = obtenerCategorias($conexion);
            if(!empty($categorias)):
            while($categoria = mysqli_fetch_assoc($categorias)):
        ?>
            <option value = "<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
        <?php 
            endwhile;
            endif;  
        ?>
        </select>
        <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'categoria'):"";?>
        <input type = "submit" value = "Crear">
    </form>

    <?php borrarErrores();?>
</main>

<?php require_once 'includes/footer.php'?>

