<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-9">
        <?= $form->field($model, 'tag_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tag_slug')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tag_description')->textArea(['maxlength' => true]) ?>

        <?= $form->field($model, 'tag_mt')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tag_md')->textArea(['maxlength' => true]) ?>

        <?= $form->field($model, 'tag_mk')->textArea(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('SAVE', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="col-lg-3">

    </div>
    <?php ActiveForm::end(); ?>

</div>
