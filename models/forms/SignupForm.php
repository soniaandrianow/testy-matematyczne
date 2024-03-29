<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.11.2017
 * Time: 16:13
 */

namespace app\models\forms;


use app\models\Parents;
use borales\extensions\phoneInput\PhoneInputValidator;
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
            ['email', 'required', 'message' => Yii::t('app', 'Mail nie może pozostac pusty.')],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\Parents', 'targetAttribute' => 'EmailAddress', 'message' => Yii::t('app', 'Email jest już zajęty.')],
            [['password', 'password_repeat'], 'required', 'message' => Yii::t('app', 'Hasło nie może pozostać puste.')],
            [['password'], 'checkPassword'],
            ['password', 'string', 'min' => 8],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Hasła muszą byc takie same.')],
            [['firstname', 'lastname', 'email', 'password'], 'required'],
            //[['DateOfRegistration'], 'safe'],
            [['firstname', 'lastname', 'password'], 'string', 'max' => 50],
            [['phone_number'], 'string', 'max' => 16],
            [['phone_number'], PhoneInputValidator::className(), 'message' => Yii::t('app', 'Niepoprawny format numeru telefonu.')],

        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'firstname' => Yii::t('app', 'Imię'),
            'lastname' => Yii::t('app', 'Nazwisko'),
            'phone_number' => Yii::t('app', 'Telefon'),
            'password' => Yii::t('app', 'Hasło'),
            'password_repeat' => Yii::t('app', 'Powtórz hasło'),
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