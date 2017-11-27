<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%difficulties}}".
 *
 * @property integer $DifficultyId
 * @property string $Name
 * @property string $Description
 *
 * @property Tasks[] $tasks
 */
class Difficulties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%difficulties}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Description'], 'required'],
            [['Name'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 255],
            [['Name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DifficultyId' => Yii::t('app', 'Difficulty ID'),
            'Name' => Yii::t('app', 'Name'),
            'Description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['DifficultyId' => 'DifficultyId']);
    }
}
