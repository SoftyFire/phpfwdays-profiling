<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Initializes tables.
 *
 * @author Dmitry Naumenko <d.naumenko.a@gmail.com>
 */
class m170618_000000_db_init extends Migration
{
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->text(),
        ]);

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->createTable('article_tags', [
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('article');
        $this->dropTable('tag');
        $this->dropTable('article_tags');
    }
}
