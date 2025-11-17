<?php
include('verifica_login.php');
include('conexao.php');

$id = $_GET['id'];
$conn->query("DELETE FROM noticias WHERE id=$id AND autor=".$_SESSION['usuario_id']);

header("Location: dashboard.php");
exit;
