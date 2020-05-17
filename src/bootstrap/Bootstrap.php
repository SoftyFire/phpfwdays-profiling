<?php

namespace app\bootstrap;

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
//        usleep(mt_rand(5e5, 2e6)); // Surprise :)
    }
}
