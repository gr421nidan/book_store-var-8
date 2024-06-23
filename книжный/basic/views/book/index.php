<?php

use app\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->identity->isAdmin()): ?>
        <p>
            <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (Yii::$app->user->identity->isAdmin()): ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                'author',
                'year',
                'published',
                //'count',
                'price',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    <?php else: ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                'author',
                'year',
                'published',
                //'count',
                'price',
                [
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::beginForm(['book/order', 'id'=>$model->id])
                            . Html::submitButton(
                                'Купить', ['class' => 'btn btn-success']);
                    }
                ],

            ],
        ]); ?>
    <?php endif; ?>


</div>
