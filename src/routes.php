<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

use App\Services\Router;

$router = new Router();

$router->add('/', 'front');

$router->add('/task', 'front/task');

$router->add('/api/shorten', 'api/shortenUrl');

$router->handle($_SERVER['REQUEST_URI']);