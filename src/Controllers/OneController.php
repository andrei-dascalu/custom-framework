<?php

namespace App\Controllers;

use App\Services\PrefixService;
use Nyholm\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class OneController
{
    public function __construct(private PrefixService $service) {}
    public function handle(RequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $contentType = $request->getHeaders();
        $response->getBody()->write(sprintf($this->service->addBoth('Hello, World <hr>[%s]!'), json_encode($contentType)));

        return $response;
    }
}
