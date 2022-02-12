<?php

use League\Route\Http\Exception as HttpException;
use Spiral\RoadRunner;
use Nyholm\Psr7;
use Nyholm\Psr7\Response;

include "./bootstrap.php";

$worker = RoadRunner\Worker::create();
$psrFactory = new Psr7\Factory\Psr17Factory();

$psr7 = new RoadRunner\Http\PSR7Worker($worker, $psrFactory, $psrFactory, $psrFactory);

while (true) {
    try {
        $request = $psr7->waitRequest();

        if (!($request instanceof \Psr\Http\Message\ServerRequestInterface)) { // Termination request received
            break;
        }

        $psr7->respond($response = $router->dispatch($request));
    } catch (HttpException $ex) {
        $psr7->respond(new Response($ex->getStatusCode(), $ex->getHeaders(), $ex->getMessage()));
    } catch (\Throwable $ex) {
        $psr7->respond(
            new Psr7\Response(
                500,
                [],
                json_encode(
                    [
                        'class'   => get_class($ex),
                        'message' => $ex->getMessage(),
                        'location' => sprintf('%s:%d', $ex->getFile(), $ex->getLine()),
                        'trace'  => $ex->getTrace(),
                    ]
                )
            )
        );
        continue;
    }
}
