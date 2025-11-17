<?php
include('verifica_login.php');
include('conexao.php');

$res = $conn->query("SELECT * FROM usuarios");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Usuários - FofoCast 💋</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Usuários cadastrados</h2>

    <?php while($u = $res->fetch_assoc()): ?>
        <div class="noticia">
            <p><b><?= $u['nome'] ?></b> — <?= $u['email'] ?></p>
            <a class="btn" href="editar_usuario.php?id=<?= $u['id'] ?>">Editar</a>
            <a class="btn btn-danger" href="excluir_usuario.php?id=<?= $u['id'] ?>">Excluir</a>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
