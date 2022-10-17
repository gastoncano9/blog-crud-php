<?php
    require_once 'includes/conexion.php';

    if(isset($_POST))
    {
        $nombre = isset($_POST['nombre']) ? mysqli_escape_string($conexion, $_POST['nombre']) :false;
        $valido = false;
        $errores = array();
        
        if(!empty($nombre) && !preg_match('/[0-9]/', $nombre) && !is_numeric($nombre))
        {
            $valido = true;
        }
        else
        {
            $errores['nombre'] = "El nombre es invalido"; 
        }

        if(count($errores) == 0)
        {
            $sql = "INSERT INTO categorias VALUES(null,'$nombre');";
            $guardar = mysqli_query($conexion, $sql);

            if($guardar)
            {
                $_SESSION['completado'] = "Se guardo correctamente";
            }
            else
            {
                $_SESSION['errores']['error-categoria'] = "Fallo al guardar";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }

    header('Location:crear-categoria.php');
?>