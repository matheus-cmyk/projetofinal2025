<?php
require_once 'conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
    
}

$sql = "SELECT * FROM usuarios WHERE id = $id";
$res = $conn->query($sql);

if (!$res || $res->num_rows == 0) {
    echo "Usuário não encontrado.";
    exit;
}

$usuario = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Perfil de <?= htmlspecialchars($usuario['nome']) ?></title>
<link rel="stylesheet" href="style.css">

<style>
    .perfil-card {
        max-width: 450px;
        margin: 40px auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .perfil-img {
        width: 180px;
        height: 180px;
        border-radius: 100%;
        object-fit: cover;
        margin-bottom: 20px;
    }
    .bio {
        margin-top: 10px;
        font-style: italic;
    }
</style>

</head>
<body>

<div class="perfil-card">

    <img 
        class="perfil-img"
        src="<?= $usuario['foto'] ?: 'https://via.placeholder.com/180' ?>"
        alt="Foto do usuário">

    <h2><?= htmlspecialchars($usuario['nome']) ?></h2>

    <?php if ($usuario['bio']): ?>
        <p class="bio"><?= nl2br(htmlspecialchars($usuario['bio'])) ?></p>
    <?php endif; ?>

</div>

<a href="index.php">← Voltar</a>

</body>
</html>
