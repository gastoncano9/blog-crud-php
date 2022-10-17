<?php

    $url = "localhost";
    $usuario = "root";
    $password = "";
    $baseDeDatos = "blog_master";

    $conexion = mysqli_connect($url, $usuario, $password, $baseDeDatos);

    mysqli_query($conexion, "SET NAMES 'utf8'");

    if(!isset($_SESSION))
    {
        session_start();
    }
?>