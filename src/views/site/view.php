<?php

/**
 * @var $this yii\web\View
 * @var \yii\data\ActiveDataProvider $dataProvider
 */


$this->title = 'View articles';
?>

<div class="site-view-news">
    <div class="body-content">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_article'
        ]) ?>
    </div>
</div>
