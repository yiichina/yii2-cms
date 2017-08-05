<?php

use yii\db\Migration;

class m170717_850926_app_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Template
        $this->createTable('{{%template}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'user_id' => $this->integer()->notNull()->comment('User ID'),
            'name' => $this->string()->notNull()->comment('Template Name'),
            'description' => $this->string()->notNull()->comment('Template Description'),
            'content' => $this->text()->notNull()->comment('Template Code'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('Template Status'),
            'created_at' => $this->integer()->notNull()->comment('Template Created Time'),
            'updated_at' => $this->integer()->notNull()->comment('Template Updated Time'),
        ], $tableOptions);

        // Node
        $this->createTable('{{%node}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
        ], $tableOptions);

        // Post
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'node_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'summary' => $this->string(),
            'source' => $this->string(),
            'image' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // Article
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
        ], $tableOptions);

        // Picture
        $this->createTable('{{%picture}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'url' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ], $tableOptions);

        // Video
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'flv' => $this->string()->notNull(),
            'length' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%template}}');
        $this->dropTable('{{%node}}');
		$this->dropTable('{{%post}}');
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%picture}}');
        $this->dropTable('{{%video}}');
    }
}
