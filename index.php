<?php
require_once 'conexao.php';
require_once 'funcoes.php';

$sql = "SELECT n.*, u.nome FROM noticias n 
        JOIN usuarios u ON n.autor = u.id 
        ORDER BY n.data DESC";

$resultado = $conn->query($sql);

if (!$resultado) {
    die("Erro na consulta SQL: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FofoCast - O portal dos babados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>FofoCast</h1>
    <p>Se é babado, a gente conta!</p>
</header>

<nav>
    <a href="index.php">Início</a>
    <?php if(usuarioLogado()): ?>
        <a href="dashboard.php">Painel</a>
        <a href="logout.php">Sair</a>
    <?php else: ?>
        <a href="login.php">Entrar</a>
        <a href="cadastro.php">Cadastrar</a>
    <?php endif; ?>
</nav>

<div class="container">
    <h2>Últimos Babados</h2>

    <?php while($n = $resultado->fetch_assoc()): ?>
        <div class="noticia">
            
            <?php if (!empty($n['imagem'])): ?>
                <img src="<?= $n['imagem'] ?>" alt="Imagem da fofoca">
            <?php endif; ?>

            <h3><?= $n['titulo'] ?></h3>

            <p><?= substr($n['noticia'], 0, 200) ?>...</p>

            <p>
                <small>
                    Por <b><?= $n['nome'] ?></b> — 
                    <?= date('d/m/Y H:i', strtotime($n['data'])) ?>
                </small>
            </p>

            <a href="noticia.php?id=<?= $n['id'] ?>" class="btn">Ler Mais</a>
        </div>
    <?php endwhile; ?>

</div>

<footer>
    <p>&copy; 2025 FofoCast - O portal dos babados</p>
</footer>

</body>
</html>
