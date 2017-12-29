<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 16:35
 */

namespace app\models\forms;


use app\models\Children;
use yii\base\Model;
use Yii;
use yii\helpers\Html;

class TestForm extends Model
{
    public $difficulty;
    public $category;
    public $child;
    public $tasks;

    public function rules()
    {
        return [
            [['difficulty', 'category', 'tasks'], 'required'],
            [['tasks'], 'safe'],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => Children::className(), 'targetAttribute' => ['child' => 'ChildId']],
            [['child'], 'required', 'message' => Html::decode(Yii::t('app', 'Musisz wybrać dziecko dla którego chcesz uruchomić test. Jeśli nie dodałeś jeszcze dzieci do swojego konta to możesz zrobic to w zakładce profilu.'))]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'child' => Yii::t('app', 'Dziecko'),
        ];
    }

}