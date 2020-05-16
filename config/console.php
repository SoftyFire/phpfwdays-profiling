<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__) . '/src',
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'runtimePath' => dirname(__DIR__) . '/runtime',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\console',
    'aliases' => [
        '@runtime' => dirname(__DIR__) . '/runtime',
        '@app/web' => dirname(__DIR__) . '/public',
    ],
    'components' => [
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'db' => $db,
        'log' => [
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => null,
            'migrationNamespaces' => [
                'app\migrations'
            ],
        ],
    ],
];

return $config;
