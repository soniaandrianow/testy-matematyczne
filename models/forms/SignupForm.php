<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.11.2017
 * Time: 16:13
 */

namespace app\models\forms;


use app\models\Parents;
use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $password;
    public $password_repeat;
    public $email;
    public $firstname;
    public $lastname;
    public $phone_number;

    private $_user;

    public function rules()
    {
        return  [
            ['email', 'trim'],
            ['email', 'required', 'message' => Yii::t('app', 'form.cannot_be_blank_email')],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\Parents', 'targetAttribute' => 'EmailAddress', 'message' => Yii::t('app', 'Email jest już zajęty.')],
            [['password', 'password_repeat'], 'required', 'message' => Yii::t('app', 'Hasło nie może pozostać puste.')],
            ['password', 'string', 'min' => 6],
            [['password'], 'checkPassword'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Hasła muszą byc takie same.')],
            [['firstname', 'lastname', 'email', 'password'], 'required'],
            //[['DateOfRegistration'], 'safe'],
            [['firstname', 'lastname', 'password'], 'string', 'max' => 50],
            [['phone_number'], 'string', 'max' => 12],

        ];
    }

    public function checkPassword()
    {
        if (!$this->hasErrors()) {
            if (!preg_match('/^(?=.*\p{Lu})(?=.*\p{Ll})(?=.*\d).{8,255}$/u', $this->password)) {
                $this->addError('password', Yii::t('app', 'Hasło musi zawierać wielką literę, małą literę, cyfrę i mieć przynajmniej 8 znaków.'));
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
        $user = new Parents();
        $user->setAttributes([
            'FirstName' => $this->firstname,
            'LastName' => $this->lastname,
            'PhoneNumber' => $this->phone_number,
            'Password' => $this->password,
            'EmailAddress' => $this->email,
            'DateOfRegistration' => date('Y-m-d H:i:s', strtotime('now')),
        ]);
        if($user->save()){
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