<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Application Profiling Master-Class';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <ol>
                <li><?= Html::a('Generate articles', ['site/generate-articles']) ?></li>
                <li><?= Html::a('View articles', ['site/view']) ?></li>
	            <li><?= Html::a('Trending news', ['site/trends']) ?></li>
            </ol>
        </div>
    </div>
</div>
