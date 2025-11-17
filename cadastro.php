<?php
include('conexao.php');
include('funcoes.php');

$erro = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if($conn->query($sql)){
        header("Location: login.php");
        exit;
    } else {
        $erro = "Erro ao criar conta! Email já pode estar sendo usado.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Criar Conta - FofoCast 💋</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form">
    <h2>Criar Conta 💋</h2>

    <?php if($erro): ?><p class="erro"><?= $erro ?></p><?php endif; ?>

    <form method="POST">
        <input type="text" name="nome" placeholder="Seu nome" required>
        <input type="email" name="email" placeholder="Seu email" required>
        <input type="password" name="senha" placeholder="Crie uma senha" required>
        <button type="submit">Cadastrar</button>
    </form>

    <p>Já tem conta? <a href="login.php">Entrar</a></p>
</div>

</body>
</html>
