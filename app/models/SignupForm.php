<?php

namespace app\models;

use yii\base\Model;

/**
 * RegistryForm is the model behind the registry form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;
    public $password_repeat;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'email', 'phone'], 'trim'],
            [['username', 'email', 'password'], 'required', 'message' => 'Поле обязательно к заполнению'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Учетная запись с указанным email уже существует'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['password', 'string', 'min' => 6, 'message' => 'Пароль должен быть длиннее 6 символов'],
            ['password_repeat', 'required', 'message' => 'Повторите пароль'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
            ['verifyCode', 'captcha']
        ];
    }


    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->date_create = time();
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
