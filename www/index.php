<?php

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../src/' . $className . '.php';
    });

    $routes = require __DIR__ . '/../src/routes.php';
    $route = $_GET['route'] ?? '';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    unset($matches[0]);

    if (!$isRouteFound) {
        throw new \Test\Exceptions\NotFoundException();
    }

    $controllerName = $controllerAndAction[0];
    $controllerAction = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$controllerAction(...$matches);

} catch (\Test\Exceptions\DbException $e) {
    $view = new \Test\View\View(__DIR__ . '/../templates/errors/');
    $view->renderHtml('500.php',
    ['title' => 'Error DB',
        'error' => $e->getMessage()],
    500);
    return;
} catch ( \Test\Exceptions\NotFoundException $e) {
    $view = new \Test\View\View(__DIR__ . '/../templates/errors/');
    $view->renderHtml('404.php',
        ['user' => \Test\Models\Users\UserAuthServices::getUserByToken(),
            'error' => $e->getMessage()], 404);
    return;
} catch (\Test\Exceptions\UnauthorizedException $e) {
    $view = new \Test\View\View(__DIR__ . '/../templates/errors/');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
    return;
} catch (\Test\Exceptions\ForbiddenException $e) {
    $view = new \Test\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('403.php',
        ['error' => $e->getMessage(),
            'title' => 'Error',
            'user' => \Test\Models\Users\UserAuthServices::getUserByToken()],
        403);
    return;
} catch (\Test\Exceptions\FilmsByFileException $e) {
    $view = new \Test\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('addByFile.php',
    ['title' => 'Error',
        'user' => \Test\Models\Users\UserAuthServices::getUserByToken(),
        'error' => $e->getMessage()]);
    return;
}