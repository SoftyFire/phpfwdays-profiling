<?php

/**
 * @var $this \yii\web\View
 * @var $model \app\models\Article
 */

?>

<article>
    <header><?= $model->title ?></header>
    <div class="text"><?= nl2br($model->text) ?></div>
    <div class="tags">
        <h5>Tags:</h5>
        <ul>
            <?php foreach ($model->tags as $tag): ?>
                <li><?= $tag->name ?> (<?= count($tag->articles) ?> more articles)</li>
            <?php endforeach; ?>
        </ul>
    </div>
</article>
