<?php

namespace app\tests;

use app\models\Article;
use app\services\ArticlesGenerator;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Blackfire\Profile\Configuration;
use Blackfire\Profile\Metric;
use joshtronic\LoremIpsum;
use PHPUnit\Framework\TestCase;

/**
 * Class ArticlesGeneratorTest
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class ArticlesGeneratorTest extends TestCase
{
    use TestCaseTrait;
    /**
     * @var ArticlesGenerator
     */
    protected $generator;

    public function setUp(): void
    {
        $this->generator = new ArticlesGenerator(new LoremIpsum());
    }

    public function testGeneratesArticles()
    {
        $config = new Configuration();
        // define some assertions
        $config
            ->defineMetric(new Metric('tags.search', '=app\models\Tag::find'))
            ->defineMetric(new Metric('tags.ensure_tag', '=' . ArticlesGenerator::class . '::ensureTag'))
//            ->assert('metrics.sql.queries.count < 20', 'SQL queries count')
            ->assert('metrics.tags.search.count < 20', 'Tags search count')
            ->assert('metrics.tags.search.count < metrics.tags.ensure_tag.count', 'Tag cache hits test')
            ->assert('metrics.http.curl.requests.count == 0', 'No network requests involved in articles generation')
            // ...
        ;

        $profile = $this->assertBlackfire($config, function () {
            $count = 12;
            $articles = $this->generator->generate($count);
            $this->assertContainsOnlyInstancesOf(Article::class, $articles);
            $this->assertTrue(count($articles) > 0, 'At least one article was generated');
            $this->assertCount($count, $articles, 'We\'ve got exactly the requested articles count');

            $article = $articles[0];
            $this->assertNotEmpty($article->title);
            $this->assertNotEmpty($article->text);
            $this->assertNotEmpty($article->id);
            $this->assertNotEmpty($article->tags);
        });
    }
}
