<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $username
 * @property int $book_id
 * @property string $status
 * @property string $date
 *
 * @property Book $book
 * @property User $username0
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'book_id'], 'required'],
            [['book_id'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Клиент',
            'book_id' => 'Книга',
            'status' => 'Статус',
            'date' => 'Дата',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[Username0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::class, ['username' => 'username']);
    }
}
