<?php

    if(isset($_POST))
    {
        require_once 'includes/conexion.php';

        if(isset($_SESSION['error-login']))
        {
            unset($_SESSION['error-login']);
        }

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";

        $login = mysqli_query($conexion, $sql);

        //significa que devuelve un solo resultado ya que el email es unico
        if($login && mysqli_num_rows($login) == 1)
        {
            $usuario = mysqli_fetch_assoc($login);

            $verificar = password_verify($password, $usuario['password']);

            if($verificar)
            {
                $_SESSION['usuario'] = $usuario;
            }
            else
            {
                $_SESSION['error-login'] = "Fallo al entrar revisa tus datos"; 
            }
        }
        else
        {
            $_SESSION['error-login'] = "Fallo al entrar revisa tus datos"; 
        }
    }

    header('Location:index.php');
?>