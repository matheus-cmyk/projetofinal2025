<?php
include ('conexao.php');
$id = $_GET ['id'];
$r = $conn->query("
SELECT noticias.*., usuarios,nomes AS autor_nome
FROM noticias
LEFT JOIN usuarios ON noticias.autor = usuarios.id
")