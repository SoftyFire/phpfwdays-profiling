<?php

namespace app\console;

use app\services\RemoteArticlesProviderInterface;
use yii\console\Controller;

class ImportController extends Controller
{
    /**
     * @var RemoteArticlesProviderInterface
     */
    private $articlesProvider;

    public function __construct($id, $module, RemoteArticlesProviderInterface $articlesProvider, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->articlesProvider = $articlesProvider;
    }

    public function actionIndex()
    {
        $articles = $this->articlesProvider->getHottestArticlesInCountry('ua');

        var_dump($articles);
    }
}
