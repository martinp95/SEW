<?php
header("Content-Type: application/json", true);
require 'conexion.php';

//Crear la bbdd
$cadenaSQL = "CREATE DATABASE IF NOT EXISTS pizzeria COLLATE utf8_spanish_ci";


if ($db->query($cadenaSQL) === TRUE) {

    $db->select_db("pizzeria");

    $crearTablaPedido = "CREATE TABLE IF NOT EXISTS Pedido (id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(30) NOT NULL,apellidos VARCHAR(60) NOT NULL, email VARCHAR(60) NOT NULL,
        nombrePizza VARCHAR(30) NOT NULL, precio  VARCHAR(30) NOT NULL,PRIMARY KEY (id))";

    //Si se crea bien la tabla de user, creo la de pizzas
    if ($db->query($crearTablaPedido) === TRUE) {


        //insertar el usuario del pedido.
        $db->select_db("Pedido");

        $consultaPre =
            $db->prepare("INSERT INTO Pedido(nombre,apellidos,email,nombrePizza,precio) VALUES (?,?,?,?,?)");

        $usuarioPedido = json_decode($_POST['datosUser']);
        $pedidoPizza = json_decode($_POST['pedido']);

        foreach ($pedidoPizza as $valor) {
            $consultaPre->bind_param('sssss',
                $usuarioPedido->nombre, $usuarioPedido->apellidos, $usuarioPedido->email,
                $valor->nombre, $valor->precio);
            $consultaPre->execute();
        }

        $consultaPre->close();

        echo json_encode($pedidoPizza[0]->nombre);

    } else {

        echo json_encode('["datosUser": "erroraco"]');
    }
} else {

    echo json_encode('["datosUser": "erroraco"]');
}
?>

