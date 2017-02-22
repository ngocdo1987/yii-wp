<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property string $id
 * @property string $post_title
 * @property string $post_slug
 * @property string $post_image
 * @property string $post_content
 * @property string $post_status
 * @property string $post_mt
 * @property string $post_md
 * @property string $post_mk
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['post_title', 'required', 'message' => 'The post title field is required.'],
            ['post_slug', 'required', 'message' => 'The post slug field is required.'],

            [['created_at', 'updated_at'], 'safe'],

            ['post_title', 'string', 'min' => 3, 'message' => 'The post title must be at least 3 characters.'],
            ['post_slug', 'string', 'min' => 3, 'message' => 'The post slug must be at least 3 characters.'],

            [['post_title', 'post_slug', 'post_image', 'post_mt', 'post_md', 'post_mk'], 'string', 'max' => 255],

            ['post_slug', 'unique', 'message' => 'The post slug has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_title' => 'Title',
            'post_slug' => 'Slug',
            'post_image' => 'Image',
            'post_content' => 'Content',
            'post_status' => 'Status',
            'post_mt' => 'Meta title',
            'post_md' => 'Meta description',
            'post_mk' => 'Meta keyword',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
                    ->viaTable('categories_posts', ['post_id' => 'id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
                    ->viaTable('posts_tags', ['post_id' => 'id']);
    }
}
