<?php

use app\models\Book;
use app\models\Stat;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'author',
            'year',
            'pages',
            //'add_date',
            [
                'attribute'=>'Status',
                'format'=>'html',
                'value'=>function(Book $book){
                    if (!Yii::$app->user->identity)
                        return '';

                    $stat = $book->userStat;

                    if (!$stat)
                        return 'я уже чиал';

                    switch ($stat->status) {
                        case Stat::IN_PROGRESS:
                            return 'читаю';
                        case Stat::DONE:
                            return 'прочитано';
                        default:
                            return '';
                    }

                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
