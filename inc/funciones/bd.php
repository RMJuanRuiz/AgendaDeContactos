<?php 

// Credenciales de BD
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'agenda');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//echo $conn -> ping(); //para comprobar conexión

?>