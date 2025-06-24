<?php
// Início da sessão e carregamento da config
session_start();
require_once __DIR__ . '/../config/config.php';

// Página solicitada
$page = $_GET['page'] ?? 'index';




// Caminhos base
$viewPath = __DIR__ . '/../app/views/' . $page . '.php';
$servicePath = __DIR__ . '/../app/services/' . $page . '.php';
$controllerPath = __DIR__ . '/../app/controllers/' . $page . '.php';

// Verifica se o arquivo existe em views
if (file_exists($viewPath)) {
    include_once $viewPath;
    exit;
}

// Verifica se o arquivo existe em services
if (file_exists($servicePath)) {
    include_once $servicePath;
    exit;
}

// Verifica se o arquivo existe em controllers
if (file_exists($controllerPath)) {
    include_once $controllerPath;
    exit;
}





// Página não encontrada
http_response_code(404);
echo "Página '$page' não encontrada.";
