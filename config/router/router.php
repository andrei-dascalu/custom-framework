<?php

use App\Controllers\OneController;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

$router = new Router();

$strategy = new ApplicationStrategy();
$strategy->setContainer($container);
$router->setStrategy($strategy);

$router->map('GET', '/', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Response();
    $contentType = $request->getHeaders();
    $response->getBody()->write(sprintf('<h1>Hello, World [%s]!</h1>', json_encode($contentType)));

    return $response;
});

$router->map('GET', '/test', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Response();
    $contentType = $request->getHeaders();
    $response->getBody()->write('No idea what to do');

    return $response;
});

$router->map('GET', '/one', [OneController::class, 'handle']);

return $router;
