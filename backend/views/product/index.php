<?php

use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            ['attribute' => 'id',
                'contentOptions' => ['style' => 'width:5rem']],
            'name',
            'description',
//            'image',
            [
                'attribute' => 'image',
                'content' => function ($model) {
                    /**
                     * @var $model \common\models\Product
                     */
                    return Html::img($model->getImageUrl(), ['style' => 'width: 6rem']);
                }
            ],
            'price:currency',

//            'status',
            ['attribute' => 'status',
                'content' => function ($model) {
                    return Html::tag('span', $model->status ? 'Active' : 'Draft', ['class' => $model->status ? 'badge badge-success' : 'badge badge-secondary']);
                }],
            'created_at:date',
            'updated_at:datetime',
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
