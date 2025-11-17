<?php

// Iniciar sessão caso ainda não tenha sido iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ------------------------------------------------------
// Verifica se o usuário está logado
// ------------------------------------------------------
function usuarioLogado() {
    return isset($_SESSION['usuario_id']);
}

// ------------------------------------------------------
// Retorna o nome do usuário logado
// ------------------------------------------------------
function nomeUsuario() {
    return isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : '';
}

// ------------------------------------------------------
// Redireciona para login caso o usuário não esteja logado
// ------------------------------------------------------
function redirecionarLogin() {
    if (!usuarioLogado()) {
        header("Location: login.php");
        exit();
    }
}

?>
