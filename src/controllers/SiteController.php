<?php

namespace app\controllers;

use app\models\Article;
use app\services\ArticlesGenerator;
use app\services\RemoteArticlesProviderInterface;
use app\services\StatsGenerator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @var ArticlesGenerator
     */
    private $articlesGenerator;
    /**
     * @var StatsGenerator
     */
    private $statsGenerator;
    /**
     * @var RemoteArticlesProviderInterface
     */
    private $remoteArticlesProvider;

    public function __construct(
        $id, Module $module,
        ArticlesGenerator $articlesGenerator, StatsGenerator $statsGenerator, RemoteArticlesProviderInterface $remoteArticlesProvider,
        array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->articlesGenerator = $articlesGenerator;
        $this->statsGenerator = $statsGenerator;
        $this->remoteArticlesProvider = $remoteArticlesProvider;
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @param int $count number of articles to be generated
     * @return string
     */
    public function actionGenerateArticles(int $count = 40): string
    {
        $this->articlesGenerator->generate($count);

        return $this->render('generation-result', [
            'number' => $count
        ]);
    }

    public function actionView(): string
    {
        return $this->render('view', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Article::find()->with(['tags', 'tags.articles'])->orderBy('id desc'),
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]),
        ]);
    }

    public function actionStats(): string
    {
        $stats = $this->statsGenerator->generate();

        return $this->render('stats', [
            'stats' => $stats
        ]);
    }

    public function actionServiceCall()
    {
        usleep(5e4);

        $probe = \BlackfireProbe::getMainInstance();
        if (\BlackfireProbe::isEnabled()) {
            $subQuery = $probe->createSubProfileQuery();
        }

        $client = new Client([
            'base_uri' => 'http://localhost:8082',
            'timeout' => 1,
        ]);
        $request = new Request('GET', 'index.php?r=site%2Fcapture-arguments', [
            'X-Blackfire-Query' => [$subQuery ?? null]
        ]);
        $response = $client->send($request);
        var_dump($response);

        return '';
    }

    public function actionTrends(): string
    {
        return $this->render('trends');
    }

    public function actionCaptureArguments()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->foo($i, random_int(1, 30));
        }
    }

    protected function foo(int $arg1, int $arg2): void
    {
        usleep($arg1 * 1e3);
        echo $arg1 . PHP_EOL;
    }

    public function actionImportTrendArticles(): string
    {
        $articles = $this->remoteArticlesProvider->getHottestArticlesInCountry('ua');

        return $this->renderAjax('import-result', [
            'importedCount' => count($articles),
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $articles,
                'pagination' => [
                    'pageSize' => count($articles),
                ],
            ]),
        ]);
    }
}
