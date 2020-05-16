<?php

/**
 * @var $this yii\web\View
 * @var \yii\data\ActiveDataProvider $dataProvider
 */


use yii\helpers\Url;

$this->title = 'Trending news';
?>

<div class="site-view-news">
    <div class="body-content">
        <button id="import">Show trending news</button>
    </div>
	<div id="result"></div>
</div>

<?php

$url = \yii\helpers\Json::htmlEncode(Url::to(['site/import-trend-articles']));

$this->registerJs(<<<JS
(function () {
    let button = document.querySelector('#import');
    let targetBlock = document.querySelector('#result');

    button.addEventListener('click', function (e) {
        button.innerText = 'Loading...';
        button.setAttribute('disabled', 'disabled');
        targetBlock.innerHTML = '';

        fetch({$url}).then(function (response) {
            button.innerText = 'Update trending news';
            button.removeAttribute('disabled');

            return response.text();
        }).then(html => {
            targetBlock.innerHTML = html;
        });
    });
})();
JS
);
