<?php
namespace app\models;


// use app\models\SignupForm;
use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;
/**
 * Signup form
 */
class UserForm extends User
{
    // public $username;
    // public $email;
    // // public $password_hash;
    // public $mobile;
    // public $filename;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 4, 'max' => 255],   

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            // ['password_hash', 'required', 'on' => 'insert'],
            // ['password_hash', 'string', 'min' => 8],
            // ['password', 'required'],
            // ['password', 'string', 'min' => 6],
            ['phone', 'required'],
            ['filename','file'],
            ['filepath', 'string'],
        ];
    }


    public function findModel($id)
    {
        if (($model = UserForm::findOne($id)) !== null) {
            return $model;
        } else {
            // throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function update_user() {
        $id = Yii::$app->user->id;
        $user = User::findOne($id);
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->filename = $this->filename;
        $user->filepath = $this->filepath;
        $user->save();
    }
}