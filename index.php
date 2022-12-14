<?php

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }

    }

    if (!$isRouteFound) {
        throw new \Kernel\Exceptions\NotFoundException();
    }
    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionNmae = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionNmae(...$matches);
} catch (\Kernel\Exceptions\DbException $e) {
    $view = new \Kernel\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage(), 500]);
} catch (\Kernel\Exceptions\NotFoundException $e) {
    $view = new \Kernel\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\Kernel\Exceptions\ForbiddenEception $e) {
    $view = new \Kernel\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage(), 403]);
}

