<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m161220_162125_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'post_title' => $this->string(255),
            'post_slug' => $this->string(255),
            'post_image' => $this->string(255),
            'post_content' => $this->text(),
            'post_status' => $this->boolean(),
            'post_mt' => $this->string(255),
            'post_md' => $this->string(255),
            'post_mk' => $this->string(255),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);
        $this->createIndex('post_title', 'posts', 'post_title');
        $this->createIndex('post_slug', 'posts', 'post_slug', true);
        $this->addCommentOnColumn('posts', 'post_title', 'Title|text');
        $this->addCommentOnColumn('posts', 'post_slug', 'Slug|text');
        $this->addCommentOnColumn('posts', 'post_image', 'Image|image');
        $this->addCommentOnColumn('posts', 'post_content', 'Content|ckeditor');
        $this->addCommentOnColumn('posts', 'post_status', 'Status|select');
        $this->addCommentOnColumn('posts', 'post_mt', 'Meta title|text');
        $this->addCommentOnColumn('posts', 'post_md', 'Meta description|textarea');
        $this->addCommentOnColumn('posts', 'post_mk', 'Meta keyword|textarea');  
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
