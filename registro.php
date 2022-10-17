<?php

    if(isset($_POST))
    {
        require_once 'includes/conexion.php';

        if(!isset($_SESSION))
        {
            session_start();
        }
        
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($conexion, $_POST['password']) : false;

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

        if(!empty($password) && strlen($password) > 8)
        {
          echo "Contraseña valida";
        }
        else
        {
            $errores['password'] = "La contraseña no cumple con los requisitos"; 
        }

        $guardarUsuario = false;

        if(count($errores) == 0)
        {
            $guardarUsuario = true;

            /*Debo cifrar la contraseña porque es ilegal no hacerlo*/
            $passwordSegura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

            $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$passwordSegura', CURDATE());";
        
            $guardar = mysqli_query($conexion, $sql);

            if($guardar)
            {
                $_SESSION['completado'] = "El registro se hizo con exito";
            }
            else
            {
                $_SESSION['errores']['general'] = "Algo fallo";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }

    header('Location:index.php');
?>