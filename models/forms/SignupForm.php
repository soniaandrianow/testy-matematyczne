<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.11.2017
 * Time: 16:13
 */

namespace app\models\forms;


use app\models\Parents;

class SignupFrom extends Parents
{
    public $password;
    public $password_repeat;
    public $email;

    private $_user;

    public function rules()
    {
        return  array_merge(parent::rules() , [
            ['email', 'trim'],
            ['email', 'required', 'message' => Yii::t('errors', 'form.cannot_be_blank_email')],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Parents', 'message' => Yii::t('app', 'Email jest już zajęty.')],
            [['password', 'password_repeat'], 'required', 'message' => Yii::t('errors', 'Hasło nie może pozostać puste.')],
            ['password', 'string', 'min' => 6],
            [['password'], 'checkPassword'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('errors', 'Hasła muszą byc takie same.')],

        ]);
    }

    public function checkPassword()
    {
        if (!$this->hasErrors()) {
            if (!preg_match('/^(?=.*\p{Lu})(?=.*\p{Ll})(?=.*\d).{8,255}$/u', $this->password)) {
                $this->addError('password', Yii::t('errors', 'Hasło musi zawierać wielką literę, małą literę, cyfrę i mieć przynajmniej 8 znaków.'));
            }
        }
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $this->setPassword($this->password);
        //$user->generateAuthKey();
        if($this->save()){
//            $auth = \Yii::$app->authManager;
//            $userRole = $auth->getRole('shooter');
//            try{
//                var_dump('TUTAJ');
//                $auth->assign($userRole, $user->getId());
//            } catch (Exception $exc){
//                Yii::error($exc->getMessage());
//                return null;
//            }
            return $this;
        }
        return null;
    }

    public function setPassword($password)
    {$this->password = $password;
        //$this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

}