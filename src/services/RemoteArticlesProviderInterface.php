<?php

namespace app\services;

use app\models\Article;

/**
 * Interface RemoteArticlesProviderInterface
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface RemoteArticlesProviderInterface
{
    /**
     * @param string $countryCode
     * @return Article[]
     */
    public function getHottestArticlesInCountry(string $countryCode): array;
}
