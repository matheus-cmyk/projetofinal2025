<?php
include('verifica_login.php');
include('conexao.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    $autor = $_SESSION['usuario_id'];
    $imagem = $_POST['imagem'];

    $sql = "INSERT INTO noticias (titulo, noticia, autor, imagem)
            VALUES ('$titulo', '$noticia', '$autor', '$imagem')";

    $conn->query($sql);
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova Fofoca 💋</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form">
    <h2>Publicar nova fofoca ✨</h2>

    <form method="POST">
        <input type="text" name="titulo" placeholder="Título do babado" required>
        <textarea name="noticia" placeholder="Conte o babado completo..." required></textarea>
        <input type="text" name="imagem" placeholder="URL da imagem (opcional)">
        <button type="submit">Publicar</button>
    </form>
</div>

</body>
</html>
