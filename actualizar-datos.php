<?php

    if(isset($_POST))
    {
        require_once 'includes/conexion.php';

        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false;
        $usuario = $_SESSION['usuario'];
        $errores = array();
        
        if(!empty($nombre) && !preg_match('/[0-9]/', $nombre) && !is_numeric($nombre))
        {
            echo "El nombre es valido";
        }
        else
        {
            $errores['nombre'] = "El nombre es invalido"; 
        }

        if(!empty($apellido) && !preg_match('/[0-9]/', $apellido) && !is_numeric($apellido))
        {
            echo "El apellido es valido";
        }
        else
        {
            $errores['apellido'] = "El apellido es invalido"; 
        }

        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "el email es valido";
        }
        else
        {
            $errores['email'] = "El email es invalido"; 
        }

        $guardarUsuario = false;

        if(count($errores) == 0)
        {
            $guardarUsuario = true;

            $consultaEmail = "SELECT id, email FROM usuarios WHERE email = '$email';";
            $usuarioEmail = mysqli_query($conexion, $consultaEmail);
            $datosUsuario = mysqli_fetch_Assoc($usuarioEmail);

            if($datosUsuario['id'] == $usuario['id'] || empty($datosUsuario))
            {
                $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', 
                    email = '$email' WHERE id = ".$usuario['id'];
        
                $guardar = mysqli_query($conexion, $sql);

                if($guardar)
                {
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellido'] = $apellido;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['completado'] = "Se actualizo con exito";
                }
                else
                {
                    $_SESSION['errores']['general'] = "Algo fallo";
                }
            }
            else
            {
                $_SESSION['errores']['general'] = "Ya existe el usuario";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }

    header('Location:mis-datos.php');
?>