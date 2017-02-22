<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property string $id
 * @property string $category_name
 * @property string $category_slug
 * @property string $category_description
 * @property string $parent_id
 * @property string $category_mt
 * @property string $category_md
 * @property string $category_mk
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['category_name', 'required', 'message' => 'The category name field is required.'],
            ['category_slug', 'required', 'message' => 'The category slug field is required.'],

            [['created_at', 'updated_at'], 'safe'],

            ['category_name', 'string', 'min' => 3, 'message' => 'The category name must be at least 3 characters.'],
            ['category_slug', 'string', 'min' => 3, 'message' => 'The category slug must be at least 3 characters.'],

            [['category_name', 'category_slug', 'category_description', 'category_mt', 'category_md', 'category_mk'], 'string', 'max' => 255],
            
            ['category_slug', 'unique', 'message' => 'The category slug has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Name',
            'category_slug' => 'Slug',
            'category_description' => 'Description',
            'parent_id' => 'Parent',
            'category_mt' => 'Meta title',
            'category_md' => 'Meta description',
            'category_mk' => 'Meta keyword',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
                    ->viaTable('categories_posts', ['category_id', 'id']);
    }
}
