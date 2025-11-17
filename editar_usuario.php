<?php
include('verifica_login.php');
include('conexao.php');

$id = $_GET['id'];
$sql = "SELECT * FROM noticias WHERE id=$id AND autor=".$_SESSION['usuario_id'];
$res = $conn->query($sql);
$n = $res->fetch_assoc();

if(!$n){
    die("Você não pode editar essa fofoca!");
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    $imagem = $_POST['imagem'];

    $conn->query("UPDATE noticias SET titulo='$titulo', noticia='$noticia', imagem='$imagem' WHERE id=$id");

    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Fofoca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form">
    <h2>Editar fofoca ✏</h2>

    <form method="POST">
        <input type="text" name="titulo" value="<?= $n['titulo'] ?>" required>
        <textarea name="noticia" required><?= $n['noticia'] ?></textarea>
        <input type="text" name="imagem" value="<?= $n['imagem'] ?>">
        <button type="submit">Salvar</button>
    </form>
</div>

</body>
</html>
