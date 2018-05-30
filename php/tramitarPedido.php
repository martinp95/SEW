<?php
header("Content-Type: application/json", true);
require 'conexion.php';

//Crear la bbdd
$cadenaSQL = "CREATE DATABASE IF NOT EXISTS pizzeria COLLATE utf8_spanish_ci";


if ($db->query($cadenaSQL) === TRUE) {

    $db->select_db("pizzeria");

    $crearTablaUserPedido = "CREATE TABLE IF NOT EXISTS userPedido (id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(30) NOT NULL,apellidos VARCHAR(60) NOT NULL, email VARCHAR(60) NOT NULL,PRIMARY KEY (id))";

    $crearTablaPizzasPedido = "CREATE TABLE IF NOT EXISTS  pizzaPedido(id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(30) NOT NULL, precio DOUBLE NOT NULL, idUserPedido INT NOT NULL, PRIMARY KEY (id),
        FOREIGN KEY (idUserPedido) REFERENCES userPedido(id))";

    //Si se crea bien la tabla de user, creo la de pizzas
    if ($db->query($crearTablaUserPedido) === TRUE) {

        if ($db->query($crearTablaPizzasPedido) === TRUE) {

            //insertar el usuario del pedido.
            $db->select_db("userPedido");

            $consultaPre =
                $db->prepare("INSERT INTO userPedido(nombre,apellidos,email) VALUES (?,?,?)");

            $usuarioPedido = json_decode($_POST['datosUser']);

            $consultaPre->bind_param('sss',
                $usuarioPedido->nombre, $usuarioPedido->apellidos, $usuarioPedido->email);

            $consultaPre->execute();

            $consultaPre->close();

            $lastID = $db->insert_id();

            //toca ahora insertar las pizzas, al ser un array tengo que ver como se hace
            // y necesito tmb el id del onjeto que acabo de insertar.

            $db->select_db("pizzaPedido");

            $consultaPizzas = $db->prepare("INSERT INTO pizzaPedido(nombre,precio,idUserPedido) VALUES (?,?,?)");

        } else {
            //Si va mal la cosa
        }
    } else {
        //Si va mal la cosa.
    }
} else {
    //Si va mal la cosa lo que devuelva el servicio tendra que hacerme entrar por fail no por success.
}


echo json_encode($_POST['datosUser']);
?>

