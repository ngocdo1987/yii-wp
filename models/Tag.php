<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property string $id
 * @property string $tag_name
 * @property string $tag_slug
 * @property string $tag_description
 * @property string $tag_mt
 * @property string $tag_md
 * @property string $tag_mk
 * @property string $created_at
 * @property string $updated_at
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['tag_name', 'required', 'message' => 'The tag name field is required.'],
            ['tag_slug', 'required', 'message' => 'The tag slug field is required.'],

            [['created_at', 'updated_at'], 'safe'],

            ['tag_name', 'string', 'min' => 3, 'message' => 'The tag name must be at least 3 characters.'],
            ['tag_slug', 'string', 'min' => 3, 'message' => 'The tag slug must be at least 3 characters.'],

            [['tag_name', 'tag_slug', 'tag_description', 'tag_mt', 'tag_md', 'tag_mk'], 'string', 'max' => 255],

            ['tag_slug', 'unique', 'message' => 'The tag slug has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => 'Name',
            'tag_slug' => 'Slug',
            'tag_description' => 'Description',
            'tag_mt' => 'Meta title',
            'tag_md' => 'Meta description',
            'tag_mk' => 'Meta keyword',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
                    ->viaTable('posts_tags', ['tag_id' => 'id']);
    }
}
