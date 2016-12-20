<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m161220_145548_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'page_title' => $this->string(255),
            'page_slug' => $this->string(255),
            'page_image' => $this->string(255),
            'page_content' => $this->text(),
            'page_status' => $this->boolean(),
            'page_mt' => $this->string(255),
            'page_md' => $this->string(255),
            'page_mk' => $this->string(255),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);
        $this->createIndex('page_title', 'pages', 'page_title');
        $this->createIndex('page_slug', 'pages', 'page_slug', true);
        $this->addCommentOnColumn('pages', 'page_title', 'Title|text');
        $this->addCommentOnColumn('pages', 'page_slug', 'Slug|text');
        $this->addCommentOnColumn('pages', 'page_image', 'Image|image');
        $this->addCommentOnColumn('pages', 'page_content', 'Content|ckeditor');
        $this->addCommentOnColumn('pages', 'page_status', 'Status|select');
        $this->addCommentOnColumn('pages', 'page_mt', 'Meta title|text');
        $this->addCommentOnColumn('pages', 'page_md', 'Meta description|textarea');
        $this->addCommentOnColumn('pages', 'page_mk', 'Meta keyword|textarea');   
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pages');
    }
}
