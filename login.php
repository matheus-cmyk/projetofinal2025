<?php
include('conexao.php');
include('funcoes.php');

$erro = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $res = $conn->query($sql);

    if ($res && $res->num_rows > 0){
        $user = $res->fetch_assoc();

        if(password_verify($senha, $user['senha'])){
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];
            header("Location: dashboard.php");
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Entrar - FofoCast</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form">
    <h2>Entrar no FofoCast</h2>
    <?php if($erro): ?><p class="erro"><?= $erro ?></p><?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="cadastro.php">Criar agora</a></p>
</div>

</body>
</html>
