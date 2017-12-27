<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%solutions}}".
 *
 * @property integer $TestId
 * @property integer $TaskId
 * @property integer $PointsGained
 * @property integer $AnswerId
 *
 * @property Answers $answer
 * @property Tasks $task
 * @property Tests $test
 */
class Solutions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%solutions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TestId', 'TaskId'], 'required'],
            [['TestId', 'TaskId', 'PointsGained', 'AnswerId'], 'integer'],
            [['AnswerId'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['AnswerId' => 'AnswerId']],
            [['TaskId'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['TaskId' => 'TaskId']],
            [['TestId'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['TestId' => 'TestId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TestId' => Yii::t('app', 'Test ID'),
            'TaskId' => Yii::t('app', 'Task ID'),
            'PointsGained' => Yii::t('app', 'Points Gained'),
            'AnswerId' => Yii::t('app', 'Answer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answers::className(), ['AnswerId' => 'AnswerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['TaskId' => 'TaskId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['TestId' => 'TestId']);
    }

    public function isCorrect()
    {
        return $this->PointsGained > 0;
    }
}
