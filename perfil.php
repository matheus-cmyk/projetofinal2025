<?php 
require_once 'conexao.php';

if(!$id){
    echo "ID inválido.";
    exit;
}

$sql = "SELECT * FROM usuarios WHERE id =$id ";
$res + $conn ->query ($sql);

if ($res || $res->num_rows == 0 ){
    echo "Usuário não encontrado.";
    exit;
}

$usuario = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Perfil</title>
</head>
<style>
        .perfil-card {
            max-width: 450px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        .perfil-card img {
            width: 100%;
            max-height: 260px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .perfil-card h2 {
            margin-bottom: 10px;
            color: #e91e63;
        }
        .bio {
            font-style: italic;
            margin-top: 10px;
        }
        a.voltar {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #e91e63;
            text-decoration: none;
        }
    </style>
<body>
<div class="perfil-card">
<?php if(!empty($usuario['foto'])): ?>
        <img src="<?= $usuario['foto'] ?>" alt="Foto de <?= $usuario['nome'] ?>">
    <?php else: ?>
        <img src="https://via.placeholder.com/450x260?text=FofoCaster" alt="Sem foto">
    <?php endif; ?>

    <h2><?= htmlspecialchars($usuario['nome']) ?></h2>

    <?php if(!empty($usuario['bio'])): ?>
        <p class="bio"><?= nl2br(htmlspecialchars($usuario['bio'])) ?></p>
    <?php endif; ?>
 </div>  

 <a clas="voltar"href="index.php">Voltar para o inicio</a>
</body>
</html>
