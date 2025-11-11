<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuração do banco de dados
$host = "localhost";
$db   = "db_pokedex";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
