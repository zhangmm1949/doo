<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a('新建用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


            'id',
            'user_name',
//            'auth_key',
//            'password',
            'email:email',
             'tel',
            [
                'attribute' => 'department_id',
                'value' => function($data){
                    return Yii::$app->params['user_department'][$data->department_id];
                }
            ],
             [
                 'attribute' => 'status',
                 'value' => function($data){
                    return $data->status == 1 ? '可用' : '不可用';
                 }
             ],
//             'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
