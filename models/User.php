<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
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
class User extends ActiveRecord implements IdentityInterface
{
    public $repeatPassword;
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
            [['name', 'surname', 'login', 'email', 'password', 'repeatPassword'], 'required'],
            [
                ['name', 'surname', 'patronymic'],
                'match',
                'pattern' => '/^[а-я\s-]*$/iu',
                'message' => 'Значение «{attribute}» должно содержать только пробел, кирилицу и тире',
            ],
            [
                ['login'],
                'match',
                'pattern' => '/^[a-z0-9-]*$/iu',
                'message' => 'Значение «{attribute}» должно содержать только цифры, латиницу и тире',
            ],
            [['rules'], 'boolean'],
            [
                ['rules'],
                'match',
                'pattern' => '/1/',
                'message' => 'Обьязательно нужно согласиться с правилами регистрации'
            ],
            [['login', 'email'], 'unique'],
            [['email'], 'email'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 6],
            [['repeatPassword'], 'compare', 'compareAttribute' => 'password'],
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
            'repeatPassword' => 'Повторите пароль',
            'rules' => 'Согласие с правилами регистрации',
        ];
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
        return true;
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
