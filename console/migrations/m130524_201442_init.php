<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // 用户信息表
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // 栏目表
        $this->createTable('{{%node}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->smallInteger()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
        ], $tableOptions);

        // 模板表
        $this->createTable('{{%template}}', [
            'id' => $this->primaryKey(),
            'name' => $this->smallInteger()->notNull()->defaultValue(10),
            'description' => $this->smallInteger()->notNull()->defaultValue(10),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // 文档信息表
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
