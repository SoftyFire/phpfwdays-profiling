<?php

/**
 * @var $this yii\web\View
 * @var int $importedCount
 * @var \yii\data\ArrayDataProvider $dataProvider
 */

$this->title = 'Articles import';
?>

<div class="site-generation-result">
    <div class="body-content">
        <div class="row">
            Imported <?= $importedCount ?> articles:
        </div>
    </div>
</div>
<div class="site-view-news">
	<div class="body-content">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_article'
        ]) ?>
	</div>
</div>
