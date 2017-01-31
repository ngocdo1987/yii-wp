<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m161220_162315_create_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'category_name' => $this->string(255),
            'category_slug' => $this->string(255),
            'category_description' => $this->string(255),
            //'parent_id' => $this->
            'category_mt' => $this->string(255),
            'category_md' => $this->string(255),
            'category_mk' => $this->string(255)
        ]);
        $this->addCommentOnColumn('categories', 'category_name', 'Name|text');
        $this->addCommentOnColumn('categories', 'category_slug', 'Slug|text');
        $this->addCommentOnColumn('categories', 'category_description', 'Description|textarea');
        $this->addCommentOnColumn('categories', 'category_mt', 'Meta title|text');
        $this->addCommentOnColumn('categories', 'category_md', 'Meta description|textarea');
        $this->addCommentOnColumn('categories', 'category_mk', 'Meta keyword|textarea');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('categories');
    }
}
