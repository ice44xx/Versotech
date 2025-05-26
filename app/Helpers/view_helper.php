<?php

function View(string $viewPath, array $params = [])
{
    extract($params);

    ob_start();
    require __DIR__ . '/../../views/' . $viewPath . '.php';
    $content = ob_get_clean();

    require __DIR__ . '/../../views/layout.php';
}
