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
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(64)->notNull(),
            'description' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // Node
        $this->createTable('{{%node}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'name' => $this->string(64)->notNull(),
            'description' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $tableOptions);

        // Post
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'user_id' => $this->integer()->notNull(),
            'node_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'summary' => $this->string(1024),
            'source' => $this->string(),
            'image' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
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
            'description' => $this->string(1024)->notNull(),
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
