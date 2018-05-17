<?php
$db = new mysqli('localhost', 'pepito', 'password2017');

if ($db->connect_error) {
    echo "<h2>ERRROR de conexion:" . $db->connect_error . ". No existe el usuario</h2>";
    exit();
} else {
    echo "<h2>Conexión establecida.</h2>";
}
?>