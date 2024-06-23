<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property string $phone
 * @property string $role
 *
 * @property Order[] $orders
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->username;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

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
            [['username', 'name', 'surname', 'password', 'phone'], 'required'],
            [['username', 'password', 'role'], 'string', 'max' => 20],
            [['name', 'surname'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 11],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'password' => 'Пароль',
            'phone' => 'Номер телефона',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['username' => 'username']);
    }
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function findByUsername($username)
    {
        return  User::findOne(['username' => $username]);
    }
    public function isAdmin()
    {
        return $this->role==='admin';
    }
}
