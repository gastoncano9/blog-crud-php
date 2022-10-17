<?php
    require_once 'includes/conexion.php';

    if(isset($_SESSION['usuario']) && isset($_GET['entrada_id']))
    {   
        $usuario_id = $_SESSION['usuario']['id'];
        $entrada_id = $_GET['entrada_id'];
        $sql = "DELETE FROM entradas WHERE id = '$entrada_id' AND usuario_id = '$usuario_id' ";
        mysqli_query($conexion, $sql);
    }

    header('Location:index.php');
?>