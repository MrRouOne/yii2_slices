<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $is_admin
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $repeat_password;
    public $rules;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'password', 'repeat_password', 'rules'], 'required',],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\s-]+$/iu', 'message' => "Поле {attribute} должно содержать только кириллицу, пробел и тире"],
            [['login'], 'match', 'pattern' => '/^[a-z0-9-]+$/iu', 'message' => "Поле {attribute} должно содержать только латиницу, цифры и тире"],
            [['rules'], 'boolean'],
            [['login', 'email'], 'unique'],
            [['email'], 'email'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 6],
            ['repeat_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
            'rules' => 'Согласие с правилами регистрации',
        ];
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password): bool
    {
        return md5($password) === $this->password;
    }
}
