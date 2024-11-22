<?php

$host = 'localhost';
$bd = 'crm';
$user = 'root';
$password = '';
$port = 3306;

$con = mysqli_connect($host, $user, $password, $bd, $port);

if (!$con) {
    die('Conexão falhou: ' . mysqli_connect_error());
}
?>
