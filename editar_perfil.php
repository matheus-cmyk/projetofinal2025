<?php
include('conexao.php');
include('funcoes.php');

redirecionarLogin();

$id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM usuarios WHERE id = $id LIMIT 1";
$res = $conn->query($sql);

if (!$res || $res->num_rows == 0) {
    die("Erro ao carregar perfil.");
}

$user = $res->fetch_assoc();
$mensagem = "";

// ==== Atualizar dados ====
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // --- Upload da foto ---
    $fotoPath = $user['foto']; // mantém a antiga se não enviar outra

    if (!empty($_FILES['foto']['name'])) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $novoNome = "foto_" . $id . "_" . time() . "." . $ext;
        $destino = "uploads/" . $novoNome;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
            $fotoPath = $destino;
        } else {
            $mensagem = "Erro ao enviar foto!";
        }
    }

    $sql_update = "UPDATE usuarios 
                   SET nome = '$nome', email = '$email', bio = '$bio', foto = '$fotoPath'
                   WHERE id = $id";

    if ($conn->query($sql_update)) {
        $_SESSION['usuario_nome'] = $nome;
        $mensagem = "Perfil atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Perfil</title>
<link rel="stylesheet" href="style.css">

<style>
    .form-box {
        max-width: 550px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    textarea {
        width: 100%;
        height: 120px;
        padding: 8px;
    }
    .foto-preview {
        width: 150px;
        height: 150px;
        border-radius: 100%;
        object-fit: cover;
        margin: 15px 0;
    }
</style>
</head>
<body>

<div class="form-box">

<h2>Editar Perfil</h2>

<?php if($mensagem): ?>
<p><b><?= $mensagem ?></b></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">

    <label>Foto de Perfil:</label><br>
    <img class="foto-preview" src="<?= $user['foto'] ?: 'https://via.placeholder.com/150' ?>">

    <input type="file" name="foto" accept="image/*">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $user['nome'] ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $user['email'] ?>" required>

    <label>Bio:</label>
    <textarea name="bio"><?= $user['bio'] ?></textarea>

    <button type="submit">Salvar Alterações</button>
</form>

<br>
<a href="dashboard.php">← Voltar ao painel</a>

</div>

</body>
</html>
