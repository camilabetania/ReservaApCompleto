<?php
// Inicia a sessão para possível autenticação
session_start();

// Configuração básica de caminhos
$base_path = dirname(__DIR__);
$redirect_to = '/pages/index.php';

// Verifica se o arquivo de destino existe
if (file_exists($base_path . $redirect_to)) {
    header("Location: $redirect_to");
} else {
    // Fallback seguro
    die("Sistema não configurado corretamente. Contate o administrador.");
}

exit;