<?php

    function mostrarErrores($errores, $campo)
    {
        $alerta = "";

        if(isset($errores[$campo]) && !empty($campo))
        {
            $alerta = "<div class = 'alerta alerta-error'>".$errores[$campo]."</div>";
        }

        return $alerta;
    }

    function borrarErrores()
    {
        if(isset($_SESSION['errores']))
        {
             unset($_SESSION['errores']);
        }

        if(isset($_SESSION['completado']))
        {
            unset($_SESSION['completado']);
        }

        if(isset($_SESSION['error-login']))
        {
            unset($_SESSION['error-login']);
        }

        if(isset($_SESSION['error-categoria']))
        {
            unset($_SESSION['error-categoria']);
        }

        if(isset($_SESSION['error-entrada']))
        {
            unset($_SESSION['error-entrada']);
        }
    }

    function obtenerCategorias($conexion)
    {
        $sql = "SELECT * FROM categorias;";
        $categorias = mysqli_query($conexion, $sql);
        $resultado = array();

        if($categorias && mysqli_num_rows($categorias) >= 1)
        {
            $resultado = $categorias;
        }

        return $resultado;
    }

    function obtenerEntradas($conexion, $limit = null, $categoria = null, $busqueda = null)
    {
        $sql = "SELECT e.*, c.nombre FROM entradas e ". 
                "INNER JOIN categorias c ON e.categoria_id = c.id ";

        if(!empty($categoria))
        {
            (int)$categoria;
            $sql .= "WHERE e.categoria_id = $categoria";
        }

        if(!empty($busqueda))
        {
            $sql.= "WHERE titulo LIKE '%$busqueda%'";
        }

        $sql .= " ORDER BY e.id DESC";
        
        if($limit != null)
        {
            $sql .= " LIMIT 4";
        }

        $entradas = mysqli_query($conexion, $sql);
        $resultado = array();

        if($entradas && mysqli_num_rows($entradas) >= 1)
        {
            $resultado = $entradas;
        }

        return $resultado;
    }

    function obtenerCategoria($conexion, $id)
    {
        $sql = "SELECT * FROM categorias WHERE id = $id;";
        $categoria = mysqli_query($conexion, $sql);
        $resultado = array();

        if($categoria && mysqli_num_rows($categoria) >= 1)
        {
            $resultado = mysqli_fetch_assoc($categoria);
        }

        return $resultado;
    }

    function obtenerEntrada($conexion, $id)
    {
        $sql = "SELECT e.*, c.nombre, CONCAT(u.nombre, ' ', u.apellido) AS 'usuario'FROM entradas e ".
                "INNER JOIN categorias c ON e.categoria_id = c.id ". 
                "INNER JOIN usuarios u ON e.usuario_id = u.id ". 
                "WHERE e.id = $id;";
        $entrada = mysqli_query($conexion, $sql);
        $resultado = array();

        if($entrada && mysqli_num_rows($entrada) >= 1)
        {
            $resultado = mysqli_fetch_Assoc($entrada);
        }

        return $resultado;
    }

   
?>