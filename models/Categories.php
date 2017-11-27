<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property integer $CategoryId
 * @property string $Name
 *
 * @property Tasks[] $tasks
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CategoryId' => Yii::t('app', 'Category ID'),
            'Name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['CategoryId' => 'CategoryId']);
    }
}
