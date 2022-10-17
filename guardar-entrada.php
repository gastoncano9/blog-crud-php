<?php
    require_once 'includes/conexion.php';

    if(isset($_POST))
    {
        $titulo = isset($_POST['titulo']) ? mysqli_escape_string($conexion, $_POST['titulo']) : false;
        $descripcion = isset($_POST['descripcion']) ? mysqli_escape_string($conexion, $_POST['descripcion']) : false;
        $categoria = isset($_POST['categoria']) ?  (int)$_POST['categoria'] : false;
        $usuario = (int)$_SESSION['usuario']['id'];
        $errores = array();

        if(empty($titulo))
        {
            $errores['titulo'] = "El titulo es invalido"; 
        }

        if(empty($descripcion))
        {
            $errores['descripcion'] = "La descripcion es invalida"; 
        }

        if(empty($categoria) && !is_numeric($categoria))
        {
            $errores['categoria'] = "La categoria es invalida"; 
        }

        if(count($errores) == 0)
        {
            if(isset($_GET['editar']))
            {
                $entrada_id = (int)$_GET['editar'];
                $sql = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', categoria_id = $categoria 
                        WHERE id = $entrada_id AND usuario_id = $usuario";
            }
            else
            {
                $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
            }

            $guardar = mysqli_query($conexion, $sql);

            if($guardar)
            {
                $_SESSION['completado'] = "Se guardo correctamente";
            }
            else
            {
                $_SESSION['errores']['error-entrada'] = "Fallo al guardar";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }

    if(isset($_GET['editar']))
    {
        header('Location:editar-entrada.php?entrada_id='.$_GET['editar']);
    }
    else
    {
        header('Location:crear-entrada.php');
    }
    
?>