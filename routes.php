<?php

namespace App;

define('ROUTES', [
    '/car' => [
        "GET" => [
            "controller" => "CarController",
            "function" => "index"
        ],
        "POST" => [
            "controller" => "CarController",
            "function" => "create",
            "middleware" => ["AuthMiddleware"]
        ]
    ],
    '/car/{}' => [
        "GET" => [
            "controller" => "CarController",
            "function" => "get"
        ],
        "PUT" => [
            "controller" => "CarController",
            "function" => "update",
            "middleware" => ["AuthMiddleware"]
        ],
    ]
]);
