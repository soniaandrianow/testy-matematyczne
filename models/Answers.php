<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%answers}}".
 *
 * @property integer $AnswerId
 * @property string $Content
 *
 * @property Solutions[] $solutions
 * @property Taskanswers[] $taskanswers
 * @property Tasks[] $tasks
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%answers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Content'], 'required'],
            [['Content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AnswerId' => Yii::t('app', 'Answer ID'),
            'Content' => Yii::t('app', 'Content'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolutions()
    {
        return $this->hasMany(Solutions::className(), ['AnswerId' => 'AnswerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskanswers()
    {
        return $this->hasMany(Taskanswers::className(), ['AnswerId' => 'AnswerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['TaskId' => 'TaskId'])->viaTable('{{%taskanswers}}', ['AnswerId' => 'AnswerId']);
    }

    public function isCorrect()
    {
        $taskans = TaskAnswers::find()->where(['AnswerId' => $this->AnswerId])->one();
        return $taskans->IsCorrect;
    }

    public function isChosen()
    {

    }
}
