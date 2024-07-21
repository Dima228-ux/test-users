<?php
/**
 * @var $provider yii\data\ActiveDataProvider
 * @var $searchModel UsersSearch
 */


use common\models\User;
use common\models\UsersSearch;
use yii\bootstrap5\Html;
use yii\grid\GridView;


$pagination = $provider->pagination;

$gridView = GridView::widget(
    [
        'dataProvider' => $provider,
        'filterModel' => $searchModel,

        'columns' => [
            'id',
            'username',
            'email',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return User::getTypeUser($model->type);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{view},{update}",
            ],

        ]
    ]
);

?>
<?
if (Yii::$app->user->identity->type == User::TYPE_ADMIN): ?>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="form-group">
                <?= Html::a('Create', ['/user/add'], ['class' => 'btn btn-mini btn-success']) ?>
            </div>
        </div>
    </div>
<?
endif; ?>
<div class="row">
    <div class="col-xs-12 col-md-10">
        <div class="box box-body box-success">
            <div class="box-header">
                <h3 class="box-title">Users list</h3>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <?php
                    echo $gridView ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
    }

    .active {
        background-color: green;
        color: white;
    }
</style>
