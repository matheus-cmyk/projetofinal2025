<?php
require_once 'conexao.php';
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$uid = $_SESSION['usuario_id'];
$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM noticias WHERE id = ? AND autor = ?");
$stmt->bind_param("ii", $id, $uid);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    die('Notícia não encontrada ou sem permissão.');
}
$noticia = $res->fetch_assoc();

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $texto = trim($_POST['noticia'] ?? '');
    $imgPath = $noticia['imagem'];

    if (!$titulo || !$texto) $erro = 'Título e notícia são obrigatórios.';
    else {
        if (!empty($_FILES['imagem']['name'])) {
            $allowed = ['image/jpeg','image/png','image/gif'];
            if (in_array($_FILES['imagem']['type'],$allowed) && $_FILES['imagem']['size'] < 3*1024*1024) {
                if (!is_dir(__DIR__.'/imagens')) mkdir(__DIR__.'/imagens',0755,true);
                $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $name = 'imagens/'.time().'_'.bin2hex(random_bytes(4)).'.'.$ext;
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__.'/'.$name)) {
                    $imgPath = $name;
                } else $erro = 'Erro ao enviar imagem.';
            } else $erro = 'Imagem inválida (jpg/png/gif até 3MB).';
        }
    }

    if (!$erro) {
        $stmt = $conn->prepare("UPDATE noticias SET titulo = ?, noticia = ?, imagem = ? WHERE id = ? AND autor = ?");
        $stmt->bind_param("sssii", $titulo, $texto, $imgPath, $id, $uid);
        if ($stmt->execute()) {
            header('Location: dashboard.php');
            exit;
        } else $erro = 'Erro ao atualizar: '.$conn->error;
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Editar Fofoca - FofoCast</title><link rel="stylesheet" href="style.css"></head>
<body>
<header><h1>FofoCast </h1><p>Editar babado</p></header>
<nav><a href="dashboard.php">Voltar</a></nav>

<div class="container">
  <h2>Editar Fofoca</h2>
  <?php if($erro): ?><div style="color:#c0392b;padding:8px;border-radius:6px;background:#fff3f3"><?=$erro?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data" class="form">
    <label>Título</label>
    <input type="text" name="titulo" value="<?=htmlspecialchars($noticia['titulo'])?>" required>

    <label>Texto</label>
    <textarea name="noticia" rows="8" required><?=htmlspecialchars($noticia['noticia'])?></textarea>

    <?php if($noticia['imagem']): ?>
      <p>Imagem atual:</p>
      <img src="<?=$noticia['imagem']?>" style="max-width:240px;border-radius:6px;margin-bottom:10px">
    <?php endif; ?>

    <label>Substituir imagem (opcional)</label>
    <input type="file" name="imagem" accept="image/*">

    <button class="btn" type="submit">Salvar Alterações</button>
  </form>
</div>

<footer class="footer">&copy; <?=date('Y')?> FofoCast</footer>
</body>
</html>
