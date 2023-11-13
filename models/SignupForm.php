<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
    *@property
 **/

class SignupForm extends Model
{
    public $username;
    public $name;
    public $surname;
    public $patronymic;
    public $email;
    public $password;
    public $password_r;
//    public $password_hash;

//    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'name', 'surname', 'patronymic', 'email'], 'required'],
            // rememberMe must be a boolean value
            ['email', 'email', 'message' => 'Почта введена некорректно'],
            ['password_r', 'compare', 'compareAttribute'=>'password'],
//            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
//            ['password', 'validatePassword'],
        ];
    }

    public function signupSave() {
        if (!$this->validate())
        {
            return null;
        }
        $user = new User();
        $user -> username = $this -> username;
//        $user -> password = $this -> password;
        $user -> name = $this -> name;
        $user -> surname = $this -> surname;
        $user -> patronymic = $this -> patronymic;
        $user -> email = $this -> email;
        $user -> password = \Yii::$app->getSecurity()->generatePasswordHash($this -> password);

        return $user->save() ? $user: null;
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Имя пользователя'),
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'email' => Yii::t('app', 'Почта'),
            'password' => Yii::t('app', 'Пароль'),
            'password_r' => Yii::t('app', 'Повтор пароля'),
        ];
    }
}