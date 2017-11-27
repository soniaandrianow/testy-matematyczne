<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tests}}".
 *
 * @property integer $TestId
 * @property integer $MaximumPoints
 * @property string $GeneratedDate
 * @property integer $ChildId
 *
 * @property Solutions[] $solutions
 * @property Tasks[] $tasks
 * @property Children $child
 */
class Tests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tests}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MaximumPoints', 'GeneratedDate', 'ChildId'], 'required'],
            [['MaximumPoints', 'ChildId'], 'integer'],
            [['GeneratedDate'], 'safe'],
            [['ChildId'], 'exist', 'skipOnError' => true, 'targetClass' => Children::className(), 'targetAttribute' => ['ChildId' => 'ChildId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TestId' => Yii::t('app', 'Test ID'),
            'MaximumPoints' => Yii::t('app', 'Maximum Points'),
            'GeneratedDate' => Yii::t('app', 'Generated Date'),
            'ChildId' => Yii::t('app', 'Child ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolutions()
    {
        return $this->hasMany(Solutions::className(), ['TestId' => 'TestId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['TaskId' => 'TaskId'])->viaTable('{{%solutions}}', ['TestId' => 'TestId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasOne(Children::className(), ['ChildId' => 'ChildId']);
    }
}
