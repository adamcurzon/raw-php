<?php

namespace App;

use App\Controller\CarController;
use App\Service\FileLoggerService;

$container = new Container();

$container->set('CarController', function () {
    return new CarController();
});

$container->set('LoggerService', function () {
    return new FileLoggerService(__DIR__ . "/logs");
});
