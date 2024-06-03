<?php

namespace App;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use App\Controller\CarController;
use App\Repository\CarRepository;
use App\Service\FileLoggerService;

$container = new Container();

$container->set('EntityManager', function () {
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: array(__DIR__ . "/src"),
        isDevMode: true,
    );

    $connection = DriverManager::getConnection([
        'driver' => 'pdo_sqlite',
        'path' => __DIR__ . '/db.sqlite',
    ], $config);

    return new EntityManager($connection, $config);
});


// Anything registerd to the container under this is not needed in CLI
if (php_sapi_name() === 'cli') {
    return;
}

$container->set('CarRepository', function () use ($container) {
    return new CarRepository(
        $container->get("EntityManager")
    );
});

$container->set('CarController', function () use ($container) {
    return new CarController(
        $container->get("CarRepository")
    );
});

$container->set('LoggerService', function () {
    return new FileLoggerService(__DIR__ . "/logs");
});
