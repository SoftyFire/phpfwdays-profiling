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
    'container' => [
        'singletons' => [
            \app\services\RemoteArticlesProviderInterface::class => function () {
                $params = Yii::$app->params;

                return new \app\services\NewsApiClient(
                    new \GuzzleHttp\Client([
                        'base_uri' => 'https://newsapi.org/v2/',
                        'headers' => [
                            'Accept' => 'application/json',
                        ],
                        'defaults' => [
                            'timeout'         => 2,
                            'allow_redirects' => false,
                        ],
                    ]),
                    $params['newsApiToken'] ?? null
                );
            },
        ]
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
