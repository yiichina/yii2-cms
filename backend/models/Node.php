<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "node".
 *
 * @property integer $id
 * @property string $parent_id
 * @property integer $name
 * @property integer $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Node extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'node';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_at', 'updated_at'], 'required'],
            [['name', 'description', 'status', 'created_at', 'updated_at'], 'integer'],
            [['parent_id'], 'string', 'max' => 255],
            [['parent_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
