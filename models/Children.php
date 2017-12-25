<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%children}}".
 *
 * @property integer $ChildId
 * @property string $FirstName
 * @property string $LastName
 * @property string $DateOfBirth
 * @property integer $ParentId
 *
 * @property Parents $parent
 * @property Tests[] $tests
 */
class Children extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%children}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FirstName', 'LastName', 'ParentId', 'DateOfBirth'], 'required'],
            [['DateOfBirth'], 'safe'],
            [['ParentId'], 'integer'],
            [['FirstName', 'LastName'], 'string', 'max' => 50],
            [['ParentId'], 'exist', 'skipOnError' => true, 'targetClass' => Parents::className(), 'targetAttribute' => ['ParentId' => 'ParentId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ChildId' => Yii::t('app', 'Child ID'),
            'FirstName' => Yii::t('app', 'Imię'),
            'LastName' => Yii::t('app', 'Nazwisko'),
            'DateOfBirth' => Yii::t('app', 'Data urodzenia'),
            'ParentId' => Yii::t('app', 'Parent ID'),
            'fullname' => Yii::t('app', 'Imię i nazwisko'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Parents::className(), ['ParentId' => 'ParentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Tests::className(), ['ChildId' => 'ChildId']);
    }

    public function getFullname()
    {
        return $this->FirstName . ' ' . $this->LastName;
    }

    public function beforeSave($insert)
    {
        $this->DateOfBirth = $this->DateOfBirth . ' ' . '00:00';
        return parent::beforeSave($insert);
    }

}
