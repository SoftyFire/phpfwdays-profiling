<?php


namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Tag
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 *
 * @property int $id
 * @property string $name
 * @property Article[] $articles
 */
class Tag extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string'],
        ];
    }

    public function getArticles(): ActiveQuery
    {
        return $this->hasMany(Article::class, ['id' => 'article_id'])->via('tagArticles');
    }

    public function getTagArticles(): ActiveQuery
    {
        return $this->hasMany(ArticleTags::class, ['tag_id' => 'id']);
    }
}
