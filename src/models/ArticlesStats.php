<?php

namespace app\models;

/**
 * Class ArticlesStats
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class ArticlesStats
{
    /**
     * @var int[]
     */
    protected $wordsCountMap = [];

    /**
     * @var int
     */
    protected $count;
    /**
     * @var array
     */
    private $tagsCountMap;

    /**
     * ArticlesStats constructor.
     *
     * @param int[] $wordsCountMap
     * @param int $articlesCount
     */
    public function __construct(array $wordsCountMap, int $articlesCount, array $tagsCountMap)
    {
        $this->wordsCountMap = $wordsCountMap;
        $this->count = $articlesCount;
        $this->tagsCountMap = $tagsCountMap;
    }

    /**
     * @return int
     */
    public function getArticlesCount(): int
    {
        return (int)$this->count;
    }

    /**
     * @param int $numberOfTopWords
     * @return string[]
     */
    public function getTopWords(int $numberOfTopWords): array
    {
        asort($this->wordsCountMap, SORT_NUMERIC);

        return array_slice(array_reverse($this->wordsCountMap), 0, $numberOfTopWords, true);
    }

    /**
     * @param int $numberOfTopTags
     * @return string[]
     */
    public function getTopTags(int $numberOfTopTags): array
    {
        asort($this->tagsCountMap, SORT_NUMERIC);

        return array_slice(array_reverse($this->tagsCountMap), 0, $numberOfTopTags, true);
    }
}
