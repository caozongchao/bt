<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "info".
 *
 * @property integer $id
 * @property string $name
 * @property string $hash
 * @property string $time
 * @property integer $num
 */
class Info extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'hash', 'num'], 'required'],
            [['time'], 'safe'],
            [['num'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['hash'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'hash' => 'Hash',
            'time' => 'Time',
            'num' => 'Num',
        ];
    }
}
