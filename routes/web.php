<?php

use App\Controllers\UserController;

function param(string $key, $default = null)
{
    return $_GET[$key] ?? $default;
}

$routes = [
    'users'  => [UserController::class, 'index'],
    'create' => [UserController::class, 'create'],
    'store'  => [UserController::class, 'store'],
    'edit'   => [UserController::class, 'edit'],
    'update' => [UserController::class, 'update'],
    'delete' => [UserController::class, 'delete'],
];

$route = param('route', 'users');

if (!isset($routes[$route])) {
    http_response_code(404);
    echo "Página não encontrada.";
    exit;
}

list($controllerClass, $method) = $routes[$route];

if (!method_exists($controllerClass, $method)) {
    http_response_code(500);
    echo "Método não encontrado no controller.";
    exit;
}

$requiresId = ['edit', 'update', 'delete'];
$id = param('id');

if (in_array($route, $requiresId, true) && (empty($id) || !is_numeric($id))) {
    http_response_code(400);
    echo "ID inválido ou ausente.";
    exit;
}

if ($id !== null) {
    $controllerClass::$method($id);
} else {
    $controllerClass::$method();
}
