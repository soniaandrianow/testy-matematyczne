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

class TestForm extends Model
{
    public $difficulty;
    public $category;
    public $child;
    public $tasks;

    public function rules()
    {
        return [
            [['difficulty', 'category', 'child', 'tasks'], 'required'],
            [['tasks'], 'safe'],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => Children::className(), 'targetAttribute' => ['child' => 'ChildId']],
        ];
    }

}