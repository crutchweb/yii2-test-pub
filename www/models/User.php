<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'safe'],
            ['id', 'integer'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['auth_key', 'string', 'max' => 32],
            ['password_hash', 'string', 'max' => 255],
            ['timestamp', 'date', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'username' => 'Имя',
            'auth_key' => 'Авторизационнный ключ',
            'password_hash' => 'Хэш пароля',
            'timestamp' => 'Дата создания',
            'timestamp_update' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * This method generating hash password
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword(string $password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * This method generating access token
     *
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    /**
     * This method creates a user
     *
     * @param string $username
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function createUser(string $username, string $password)
    {
        $this->username = $username;
        $this->setPassword($password);
        $this->generateAuthKey();
        $this->save();
    }

    public function deleteUser()
    {
        //init sample code here
    }

    public function deleteUsers()
    {
        //init sample code here
    }
}
