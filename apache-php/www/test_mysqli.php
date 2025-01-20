<?php
$servername = "db";
$username = "prueba";
$password = "prueba";
$dbname = "prueba";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
echo "Conexión exitosa a la base de datos!";
mysqli_close($conn);
?>
