<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tag_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag_slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag_mt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag_md')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag_mk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
