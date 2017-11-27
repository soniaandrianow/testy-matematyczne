<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%parents}}".
 *
 * @property integer $ParentId
 * @property string $FirstName
 * @property string $LastName
 * @property string $PhoneNumber
 * @property string $EmailAddress
 * @property string $Password
 * @property string $DateOfRegistration
 *
 * @property Children[] $childrens
 */
class Parents extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%parents}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FirstName', 'LastName', 'EmailAddress', 'Password', 'DateOfRegistration'], 'required'],
            [['DateOfRegistration'], 'safe'],
            [['FirstName', 'LastName', 'Password'], 'string', 'max' => 50],
            [['PhoneNumber'], 'string', 'max' => 12],
            [['EmailAddress'], 'string', 'max' => 125],
            [['EmailAddress'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ParentId' => Yii::t('app', 'Parent ID'),
            'FirstName' => Yii::t('app', 'Imię'),
            'LastName' => Yii::t('app', 'Nazwisko'),
            'PhoneNumber' => Yii::t('app', 'Telefon'),
            'EmailAddress' => Yii::t('app', 'Email'),
            'Password' => Yii::t('app', 'Hasło'),
            'DateOfRegistration' => Yii::t('app', 'Data rejestracji'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildrens()
    {
        return $this->hasMany(Children::className(), ['ParentId' => 'ParentId']);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return Parents::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->ParentId;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->Password === $password;
    }

    public static function findByEmail($email)
    {
        return Parents::findOne(['EmailAddress' => $email]);
    }

}
