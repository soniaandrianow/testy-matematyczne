<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 29.12.2017
 * Time: 10:45
 */

namespace app\models\forms;


use app\models\Parents;
use Yii;
use yii\base\Model;

class PasswordResetForm extends Model
{
    const STATUS_EMAIL_SENT = 'email_sent';

    /**
     * User email or phone
     * @var string
     */
    public $email;
    /**
     * User object.
     * @var Parents
     */
    private $_user;

    /**
     * Captcha
     * @var string
     */
    public $captcha;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'required', 'message' => Yii::t('app', 'Email nie może pozostać pusty.')],
            ['email', 'string'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
        ];
    }
    /**
     * Returns user object.
     * @return User
     */
    protected function _getUser()
    {
        if ($this->_user === null) {
            $this->_user = Parents::findByEmail($this->email);
        }
        return $this->_user;
    }
    /**
     * Starts password resetting.
     * @return boolean
     */
    public function sendEmail()
    {
        $user = $this->_getUser();
        if (!$user) {
            return false;
        }
        return $user->requestReset();
    }
    /**
     * Sends notifications, adds successes and errors.
     */
    public function sendNotifications()
    {
        if ($this->_getUser()) {
            if ($this->sendEmail()) {
                return self::STATUS_EMAIL_SENT;
            }
        }
    }
}