<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Página principal de la pagina web dedicada a la venta de pizzas"/>
    <meta name="keywords" content="pizzas, pizzeria, carta, conocenos"/>
    <link rel="icon" href="../img/iconoPizza.jpg" type="image/jpg"/>
    <!-- Espacio para meter las hojas de estilos o los diferentes scrips-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/reloj.js" language="JavaScript"></script>
    <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
    <link href="../css/reloj.css" rel="stylesheet" type="text/css"/>
    <link href="../css/navBar.css" rel="stylesheet" type="text/css"/>
    <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
    <title>Pizzería EII</title>
</head>
<body>
<div id="clockDate">
    <p id="date"></p>
    <ul id="clock">
        <li id="hours"></li>
        <li class="dot">:</li>
        <li id="minutes"></li>
        <li class="dot">:</li>
        <li id="seconds"></li>
    </ul>
</div>
<header>
    <a href="../index.html" title="Ir a la página principal">Pizzería EII</a>
</header>
<nav>
    <ul id="lista_menu">
        <li><a href="../index.html">Principal</a></li>
        <li><a href="../html/conocenos.html">Conócenos</a></li>
        <li><a href="../html/productos.html">Productos</a>
            <ul>
                <li><a href="../xml/pizzas.xml">Pizzas</a></li>
                <li><a href="../xml/pizzasEspeciales.xml">Pizzas Especiales</a></li>
            </ul>
        </li>
        <li><a href="../html/contacto.html">Contacto</a></li>
        <li><a href="../html/locales.html">Locales</a></li>
    </ul>
</nav>
<main>
    <?php
    require 'conexion.php';

    //Crear la bbdd
    $cadenaSQL = "CREATE DATABASE IF NOT EXISTS pizzeria COLLATE utf8_spanish_ci";

    //Si va sbien creo la tabla.
    if ($db->query($cadenaSQL) === TRUE) {

        //crear la tabla
        $db->select_db("pizzeria");

        $crearTabla = "CREATE TABLE IF NOT EXISTS comentarios (id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(30) NOT NULL,apellidos VARCHAR(60) NOT NULL, email VARCHAR(60) NOT NULL,
        texto VARCHAR(500) NOT NULL, PRIMARY KEY (id))";

        //Si se crea con exito inserto el comentario.
        if ($db->query($crearTabla) === TRUE) {

            //insertar comentario
            $db->select_db("comentarios");

            $consultaPre =
                $db->prepare("INSERT INTO comentarios(nombre,apellidos,email,texto) VALUES (?,?,?,?)");

            $consultaPre->bind_param('ssss',
                $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["comentario"]);

            $consultaPre->execute();

            $consultaPre->close();

            //Meter aqui lo que quiero que muestre la pagina de la que se
            // çinserte el comentario en plan mensaje de agradecimiento guapo o tal.
            echo "<h1>Muchas gracias por sus sugerencias.</h1>
            <p>Gracias a sus comentarios nos ayuda a mejorar el sitio para proporcionarle una mejor esperiencia.</p>";


        } else {
            echo "<p>Se ha producido  un error por favor intentelo mas tarde.</p>";
            exit();
        }

    } else {
        echo "<p>Se ha producido  un error por favor intentelo mas tarde.</p>";
        exit();
    }

    //Cerrar la conexion
    $db->close();
    ?>
</main>
<footer>
    <div>
        <span>
            &copy; Copyright 2018 - Pizzería EII -  Derechos reservados
        </span>
        <span>
                Pagina web hecha por:
                <a href="mailto:uo236974@uniovi.es">Martín Peláez Díaz</a>
            </span>
    </div>

    <div>
        <h3>Mapa web</h3>
        <ul>
            <li><a href="../index.html">Principal</a></li>
            <li><a href="../html/conocenos.html">Conócenos</a></li>
            <li><a href="../html/productos.html">Productos</a></li>
            <li><a href="../html/contacto.html">Contacto</a></li>
            <li><a href="../html/locales.html">Locales</a></li>
        </ul>
    </div>

    <div class="accesibilidad">

    </div>
</footer>

</body>
</html>
