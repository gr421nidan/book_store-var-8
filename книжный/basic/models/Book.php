<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string $author
 * @property string $year
 * @property string $published
 * @property int $count
 * @property string $price
 *
 * @property Order[] $orders
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author', 'year', 'published', 'count', 'price'], 'required'],
            [['count'], 'integer'],
            [['name', 'author', 'published'], 'string', 'max' => 30],
            [['year'], 'string', 'max' => 4],
            [['price'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'author' => 'Автор',
            'year' => 'Год выпуска',
            'published' => 'Издательство',
            'count' => 'Количество',
            'price' => 'Цена',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['book_id' => 'id']);
    }
}
