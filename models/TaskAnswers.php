<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%taskanswers}}".
 *
 * @property integer $TaskId
 * @property integer $AnswerId
 * @property integer $IsCorrect
 *
 * @property Answers $answer
 * @property Tasks $task
 */
class TaskAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%taskanswers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TaskId', 'AnswerId', 'IsCorrect'], 'required'],
            [['TaskId', 'AnswerId', 'IsCorrect'], 'integer'],
            [['AnswerId'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['AnswerId' => 'AnswerId']],
            [['TaskId'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['TaskId' => 'TaskId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TaskId' => Yii::t('app', 'Task ID'),
            'AnswerId' => Yii::t('app', 'Answer ID'),
            'IsCorrect' => Yii::t('app', 'Is Correct'),
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
}
