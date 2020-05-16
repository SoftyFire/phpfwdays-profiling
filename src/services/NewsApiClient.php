<?php

namespace app\services;

use app\models\Article;
use GuzzleHttp\ClientInterface;
use InvalidArgumentException;

/**
 * Class NewsApiClient
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class NewsApiClient implements RemoteArticlesProviderInterface
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var string|null
     */
    private $apiKey;

    public function __construct(ClientInterface $client, ?string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $countryCode
     * @return Article[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHottestArticlesInCountry(string $countryCode): array
    {
        if ($this->apiKey === null) {
            throw new InvalidArgumentException('Get NewsAPI API key on https://newsapi.org/register and put in to ./config/params.php');
        }

        $response = $this->client->request('GET', 'top-headlines', [
            'query' => [
                'country' => $countryCode,
                'apiKey' => $this->apiKey
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return array_map(function (array $row): Article {
            return $this->poppulateArticle($row);
        }, $result['articles']);
    }

    private function poppulateArticle(array $row): Article
    {
        $article = new Article();
        $article->setAttributes([
            'title' => $row['title'],
            'text' => $row['description'],
        ]);

        return $article;
    }
}
