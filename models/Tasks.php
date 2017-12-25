<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property integer $TaskId
 * @property string $Content
 * @property integer $NumberOfPoints
 * @property integer $CategoryId
 * @property integer $DifficultyId
 *
 * @property Solutions[] $solutions
 * @property Tests[] $tests
 * @property Taskanswers[] $taskanswers
 * @property Answers[] $answers
 * @property Categories $category
 * @property Difficulties $difficulty
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Content', 'CategoryId', 'DifficultyId'], 'required'],
            [['NumberOfPoints', 'CategoryId', 'DifficultyId'], 'integer'],
            [['Content'], 'string', 'max' => 500],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['CategoryId' => 'CategoryId']],
            [['DifficultyId'], 'exist', 'skipOnError' => true, 'targetClass' => Difficulties::className(), 'targetAttribute' => ['DifficultyId' => 'DifficultyId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TaskId' => Yii::t('app', 'Task ID'),
            'Content' => Yii::t('app', 'Content'),
            'NumberOfPoints' => Yii::t('app', 'Number Of Points'),
            'CategoryId' => Yii::t('app', 'Category ID'),
            'DifficultyId' => Yii::t('app', 'Difficulty ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolutions()
    {
        return $this->hasMany(Solutions::className(), ['TaskId' => 'TaskId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Tests::className(), ['TestId' => 'TestId'])->viaTable('{{%solutions}}', ['TaskId' => 'TaskId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskanswers()
    {
        return $this->hasMany(Taskanswers::className(), ['TaskId' => 'TaskId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['AnswerId' => 'AnswerId'])->viaTable('{{%taskanswers}}', ['TaskId' => 'TaskId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['CategoryId' => 'CategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDifficulty()
    {
        return $this->hasOne(Difficulties::className(), ['DifficultyId' => 'DifficultyId']);
    }

    public function getCorrect()
    {
        return TaskAnswers::find()->where(['TaskId' => $this->TaskId])->andWhere(['IsCorrect' => 1])->one()->AnswerId;
    }
}
