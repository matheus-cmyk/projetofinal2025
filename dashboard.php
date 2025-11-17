<?php
include('funcoes.php');
redirecionarLogin();

include('conexao.php');

$idUser = $_SESSION['usuario_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel - FofoCast 💋</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Painel do Fofoqueiro 💋</h1>
</header>

<div class="container">
    <h2>Olá, <?= $_SESSION['usuario_nome'] ?>!</h2>

    <a class="btn" href="nova_noticia.php">✨ Publicar nova fofoca</a>
    <a class="btn" href="usuarios.php">👤 Gerenciar usuários</a>
    <a class="btn" href="logout.php">🚪 Sair</a>

    <h3>Suas fofocas publicadas</h3>

    <?php
    $sql = "SELECT * FROM noticias WHERE autor=$idUser ORDER BY data DESC";
    $res = $conn->query($sql);

    if ($res && $res->num_rows > 0):
        while($n = $res->fetch_assoc()):
    ?>
        <div class="noticia">
            <h3><?= $n['titulo'] ?></h3>
            <a class="btn" href="editar_noticia.php?id=<?= $n['id'] ?>">✏ Editar</a>
            <a class="btn btn-danger" href="excluir_noticia.php?id=<?= $n['id'] ?>">🗑 Excluir</a>
        </div>
    <?php endwhile; else: ?>
        <p>Você ainda não publicou nenhuma fofoca 😢</p>
    <?php endif; ?>
</div>

</body>
</html>
