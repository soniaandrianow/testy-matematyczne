<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.11.2017
 * Time: 15:41
 */
namespace app\models\forms;
use app\models\Parents;
use yii\base\Model;
use Yii;

class PasswordForm extends Parents
{
    public $password;
    public $new_password;
    public $new_password_repeat;

    public function rules()
    {
       return [
           [['password'], 'required'],
           [['password'], 'validatePasswordToEdit'],
           ['new_password', 'string', 'min' => 8],
           [['new_password'], 'validateNewPassword'],
           [['new_password_repeat'], 'compare', 'compareAttribute' => 'new_password', 'message'=>Yii::t('app', 'Powtórzenie hasła musi byc takie samo jak hasło.')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password'            => Yii::t('app', 'Aktualne hasło'),
            'new_password'        => Yii::t('app', 'Nowe hasło'),
            'new_password_repeat' => Yii::t('app', 'Powtórz nowe hasło'),
        ];
    }

    public function validateNewPassword()
    {
        if (!$this->hasErrors()) {
            if($this->validatePassword($this->new_password)){
                $this->addError('new_password', Yii::t('app', 'Nowe hasło nie może być takie samo jak aktualne.'));
                return;
            }
            if (!preg_match('/^(?=.*\p{Lu})(?=.*\p{Ll})(?=.*\d).{8,255}$/u', $this->new_password)) {
                $this->addError('new_password', Yii::t('app', 'Hasło musi zawierać wielką literę, małą literę, cyfrę i mieć przynajmniej 8 znaków.'));
                return;
            }
            if (!$this->new_password_repeat && $this->new_password) {
                $this->new_password = null;
                $this->new_password_repeat = null;
                $this->addError('new_password_repeat', Yii::t('app', 'Podane hasła różnią się.'));
                return;
            }
        }
    }

    public function validatePasswordToEdit()
    {
        if (!$this->hasErrors()) {
            if (!Yii::$app->user->identity->validatePassword($this->password)) {
                $this->addError('password', Yii::t('app', 'Hasło jest niepoprawne'));
            }
        }
    }
}