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
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('categories');
    }
}
