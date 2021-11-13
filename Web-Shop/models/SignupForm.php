<?php
namespace app\models;

use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;

class SignupForm extends ActiveRecord
{
    public $fullname;
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['fullname', 'required'],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->fullname = $this->fullname;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->web_shop = true;
            
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
}