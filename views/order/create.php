<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use kucha\ueditor\UEditor;
use app\models\System;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = '新建工单';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">
    <?php $form = ActiveForm::begin(); ?>

    <?php if (Yii::$app->user->identity->isAdmin): ?>
        <?= $form->field($model, 'present_user')->dropDownList(User::getUserList(false,1), ['prompt' => '请选择', 'style' => 'width:20%', 'id'=>'present_user']) ?>
    <?php else: ?>
        <?= $form->field($model, 'present_user')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
    <?php endif; ?>

    <?= $form->field($model, 'system')->dropDownList(System::getUsableSystems(), ['prompt' => '请选择系统', 'style' => 'width:20%', 'id' => 'system']) ?>

    <?= $form->field($model, 'level')->dropDownList(Yii::$app->params['order_level'], ['style' => 'width:20%']) ?>

    <?= $form->field($model, 'title')->input('text', ['placeholder' => '一句话描述，简明扼要。不超过50字', 'style' => 'width:50%']); ?>

    <?= $form->field($model, 'content')->widget(UEditor::class,['clientOptions' => Yii::$app->params['UEditor_clientOptions']]) ?>

    <?= $form->field($model, 'tags')->input('text', ['style' => 'width:50%']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    /* 根据系统筛选用户
    $("#system").change(() => {
        let system_id = $("#system").val();
        $.ajax({
            type:"GET",
            url:"/user/get-user-ids-by-system/?system_id=" + system_id,
            success:(data) => {
                data = JSON.parse(data);
                // console.log(data);
                $("#present_user option").each(function (index, e) {
                    // console.log($(e));
                    if (data.includes(parseInt($(e).val()))){
                        $(e).css("display",'block');
                    }else{
                        $(e).css("display", "none");
                    }
                });
            }
        });
    });*/
</script>