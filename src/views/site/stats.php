<?php

/**
 * @var $this yii\web\View
 * @var \app\models\ArticlesStats $stats
 */


$this->title = 'View stats';
?>

<div class="site-view-news">
    <div class="body-content">
        Total articles: <?= $stats->getArticlesCount() ?><br />
        Top words:
        <ul>
            <?php foreach ($stats->getTopWords(20) as $word => $count) : ?>
                <li><?= $word ?> - <?= $count ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
