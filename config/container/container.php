<?php

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(true);

// $builder->enableCompilation(__DIR__ . '/tmp');
// $builder->writeProxiesToFile(true, __DIR__ . '/tmp/proxies');

$builder->addDefinitions(__DIR__ . '/autowired.php');

$container = $builder->build();

return $container;
