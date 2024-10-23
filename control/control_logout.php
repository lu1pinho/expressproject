<?php
session_start(); // Inicia ou retoma a sessão

// Verifica se a sessão está ativa
if (isset($_SESSION['usuario_id'])) {
    // Se existir, destrói a sessão
    session_unset(); // Limpa todas as variáveis de sessão
    session_destroy(); // Destrói a sessão
}

header("Location: /expressproject/control/control_pagina-principal.php");
exit();
?>
