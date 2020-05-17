<?php

namespace app\bootstrap;

use Blackfire\Client;
use Blackfire\Profile\Configuration;
use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if (true) {
            return;
        }

        $blackfire = new Client();

        $config = new Configuration();
        $config->assert('main.wall_time < 1s', 'Execution time is not too fat');

        $probe = $blackfire->createProbe($config);

        register_shutdown_function(function() use ($blackfire, $probe) {
            $blackfire->endProbe($probe);
        });
    }
}
