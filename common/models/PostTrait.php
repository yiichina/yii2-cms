<?php

namespace common\models;

use Yii;

Trait PostTrait
{
    public $node_id;
    public $title;
    public $status;
    public $tags;

    private $_transaction;

    private $postRules =  [
        [['title', 'node_id'], 'required'],
    ];

    /**
     * @inheritdoc
     */
    public function checkWords()
    {
        if (!$this->hasErrors()) {
            foreach(Yii::$app->params['badWords'] as $data) {
                if(strpos($this->title, $data) !== false) {
                    $this->addError('title', '您的标题包含非法字符。');
                    break;
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '作者',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'created_at' => '发布时间',
            'updated_at' => '修改时间',
        ];
    }
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            $this->_transaction = Yii::$app->db->beginTransaction();
            if($insert) {

            } else {
                $this->updated_at = time();
            }
            return true;
        } else {
            return false;
        }
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        //$db = Yii::$app->db;
        //$transaction = $db->beginTransaction();
        try {
            $post = new Post();
            $post->node_id = 1;
            $post->user_id = 1;
            $post->title = $this->title;
            $post->save();
            $this->post_id = $post->id;
            return parent::save($runValidation, $attributeNames);
            //$transaction->rollBack();
        } catch(\Exception $e) {
            //$transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            //$transaction->rollBack();
            throw $e;
        }
    }
}
