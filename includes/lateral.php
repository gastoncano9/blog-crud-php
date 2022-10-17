
<aside id = "sidebar">

    <div class = "bloque">
        <h3>Buscar</h3>

        <form action = "buscar.php" method = "POST">
            <input type = "text" name = "busqueda">

            <input type = "submit" value = "Buscar">
        </form>
    </div>

    <?php if(isset($_SESSION['usuario'])) :?>
        <div class = "bloque">
            <h3>Bienvenido, <?=$_SESSION['usuario']['nombre']." ". $_SESSION['usuario']['apellido']?></h3>
            <a class = "boton boton-verde" href = "crear-entrada.php">Crear entrada</a>
            <a class = "boton" href = "crear-categoria.php">Crear categoria</a>
            <a class = "boton boton-naranja" href = "mis-datos.php">Mis datos</a>
            <a class = "boton boton-rojo" href = "logout.php">Cerrar sesión</a>
        </div>
    <?php endif;?>

    <?php if(!isset($_SESSION['usuario'])) :?>
        <div class = "bloque">
            <h3>Identificate</h3>

            <?php if(isset($_SESSION['error-login'])):?>
                <div class = "alerta alerta-error">
                    <h3><?= $_SESSION['error-login']?></h3>
                </div>
            <?php endif;?>

            <form action = "login.php" method = "POST">
                <label for = "email">Email</label>
                <input type = "email" name = "email">

                <label for = "password">Contraseña</label>
                <input type = "password" name = "password">

                <input type = "submit" value = "Entrar">
            </form>
        </div>
    <?php endif;?>
    
    <?php if(!isset($_SESSION['usuario'])) :?>
        <div class = "bloque">
            <h3>Registrate</h3>
            <?php if(isset($_SESSION['completado'])):?>
                <div class = "alerta">
                    <?= $_SESSION['completado'];?>
                </div>
            <?php elseif(isset($_SESSION['errores']['general'])):?>
                <div class = "alerta alerta-error">
                    <?= $_SESSION['errores']['general'];?>
                </div>
                <?php borrarErrores();?>
            <?php endif;?>

            <form action = "registro.php" method = "POST">

                <label for = "nombre">Nombre</label>
                <input type = "text" name = "nombre">

                <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'nombre'):"";?>

                <label for = "apellido">Apellido</label>
                <input type = "text" name = "apellido">

                <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'apellido'):"";?>

                <label for = "email">Email</label>
                <input type = "email" name = "email">

                <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'email'):"";?>

                <label for = "password">Contraseña</label>
                <input type = "password" name = "password">

                <?php echo isset($_SESSION['errores'])?mostrarErrores($_SESSION['errores'], 'password'):"";?>

                <input type = "submit" value = "Registrar">
            </form>
            <?php borrarErrores();?>
        </div>
    <?php endif;?>
</aside>