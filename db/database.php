<?php

$server = 'localhost:3308';
$username = 'root';
$password = '';
$database = 'archivoregionalboyaca';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Conexion Fallida: ' . $e->getMessage());
}

?>