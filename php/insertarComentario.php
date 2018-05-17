<?php
require 'conexion.php';

//Crear la bbdd
$cadenaSQL = "CREATE DATABASE IF NOT EXISTS pizzeria COLLATE utf8_spanish_ci";
if ($db->query($cadenaSQL) === TRUE) {
    echo "<h2>Base de datos comentarios creada con éxito (o ya existe)</h2>";
} else {
    echo "<h2>ERROR en la creación de la Base de Datos comentarios</h2>";
    exit();
}

//crear la table
$db->select_db("pizzeria");

$crearTabla = "CREATE TABLE IF NOT EXISTS comentarios (id INT NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(30) NOT NULL,apellidos VARCHAR(60) NOT NULL, email VARCHAR(60) NOT NULL,
  texto VARCHAR(500) NOT NULL, PRIMARY KEY (id))";

if ($db->query($crearTabla) === TRUE) {
    echo "<p>Tabla Articulo creada con éxito o ya existe</p>";
} else {
    echo "<p>ERROR en la creación de la tabla</p>";
    exit();
}
$db->select_db("comentarios");

$consultaPre =
    $db->prepare("INSERT INTO comentarios(nombre,apellidos,email,texto) VALUES (?,?,?,?)");

$consultaPre->bind_param('ssss',
    $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["comentario"]);

$consultaPre->execute();

echo "<p>Filas agregadas: " . $consultaPre->affected_rows . "</p>";

$consultaPre->close();
$db->close();
?>