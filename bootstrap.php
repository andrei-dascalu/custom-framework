<?php

use DI\Container;
use League\Route\Router;

require_once "vendor/autoload.php";

/** @var Container $container */
$container = require_once "config/container/container.php";

/** @var Router $router */
$router = require_once "config/router/router.php";
