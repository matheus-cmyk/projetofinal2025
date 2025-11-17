<?php
include('verifica_login.php');
include('conexao.php');

$id = $_GET['id'];
$conn->query("DELETE FROM usuarios WHERE id=$id");
header("Location: usuarios.php");
exit;
