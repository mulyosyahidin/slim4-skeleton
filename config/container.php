<?php

use Psr\Container\ContainerInterface;
use Selective\Database\Connection;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        $app = AppFactory::createFromContainer($container);

        // Register routes
        (require __DIR__ . '/routes.php')($app);

        // Register middleware
        (require __DIR__ . '/middleware.php')($app);

        return $app;
    },

    // Database connection
    Connection::class => function (ContainerInterface $container) {
        return new Connection($container->get(PDO::class));
    },

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['db'];

        $driver = $settings['driver'];
        $host = $settings['host'];
        $port = $settings['port'];
        $dbname = $settings['database'];
        $username = $settings['username'];
        $password = $settings['password'];
        $charset = $settings['charset'];
        $flags = $settings['options'];
        $dsn = "$driver:host=$host;port=$port;dbname=$dbname;charset=$charset";

        return new PDO($dsn, $username, $password, $flags);
    },

];
