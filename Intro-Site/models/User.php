<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
   
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static function tableName() {
        return '{{%user}}';
    }

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public function rules() {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    // public function getPhotoInfo() {
    //     $path=Url::to('@webroot/images/');
    //     $url=Url::to('@web/images/');
    //     $filename=strtolower($this->username).'.jpg';
    //     $alt=$this->username."'s Profile Picture";
        
    //     $imageInfo = ['alt'=>$alt];
    //     if(file_exists($path.$filename)){
    //         $imageInfo['url'] = $url.$filename;            
    //     }else{
    //         $imageInfo['url'] = $url."user-placeholder.jpg";      
    //     }
    //     return $imageInfo;
    // }
}