<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property string $id
 * @property string $page_title
 * @property string $page_slug
 * @property string $page_image
 * @property string $page_content
 * @property string $page_status
 * @property string $page_mt
 * @property string $page_md
 * @property string $page_mk
 * @property string $created_at
 * @property string $updated_at
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_title', 'page_slug'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['page_title', 'page_slug'], 'string', 'min' => 3],
            [['page_title', 'page_slug', 'page_image', 'page_mt', 'page_md', 'page_mk'], 'string', 'max' => 255],
            [['page_slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_title' => 'Title',
            'page_slug' => 'Slug',
            'page_image' => 'Image',
            'page_content' => 'Content',
            'page_status' => 'Status',
            'page_mt' => 'Meta title',
            'page_md' => 'Meta description',
            'page_mk' => 'Meta keyword',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ];
    }
}
