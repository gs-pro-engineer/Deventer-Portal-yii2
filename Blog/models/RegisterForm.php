<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $firstName;
    public $middleName;
    public $lastName;
    public $username;
    public $email;
    public $accessToken;
    public $userRole;
    public $password;
    public $passwordConfirm;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // firstName, middleName, lastName, email, password and uesrRole are both required
            [['firstName', 'middleName', 'lastName', 'username', 'email', 'userRole', 'password', 'passwordConfirm'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['passwordConfirm', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if ($this->password !== $this->passwordConfirm) {
              $this->addError($attribute, 'Please input password in two fields correctly.');
            } else {
              $user = $this->saveUser();
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        // if ($this->validate()) {
        //     return Yii::$app->user->register($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        // }
        // return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function saveUser()
    {
        // if ($this->_user === false) {
        //     $this->_user = User::findByEmail($this->email);
        // }

        // return $this->_user;
    }
}
