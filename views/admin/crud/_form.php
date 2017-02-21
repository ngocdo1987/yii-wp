<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-9">
        <?php if(!empty($config)) : ?>
            <?php foreach($config->cols as $k => $v) : ?>
                <?php
                    switch($v->type) {
                        case 'text':
                            echo $form->field($model, $k)->textInput(['maxlength' => true]);
                            break;
                        case 'textarea':
                            echo $form->field($model, $k)->textarea(['maxlength' => true, 'rows' => 8]);
                            break;        
                        case 'ckeditor':
                            echo $form->field($model, $k)->textarea(['maxlength' => true, 'rows' => 8, 'id' => 'ckeditor']);
                            break;
                        case 'tinymce':
                            echo $form->field($model, $k)->textarea(['maxlength' => true, 'rows' => 8]);
                            break;   
                        case 'summernote':
                            echo $form->field($model, $k)->textarea(['maxlength' => true, 'rows' => 8, 'class' => 'summernote']);
                            break;             
                        case 'select':

                            break;
                        case 'select_recursive':
                        
                            break;        
                        case 'select_multiple':
                        
                            break;        
                        case 'radio':
                        
                            break;
                        case 'checkbox':
                        
                            break;      
                        case 'file':

                            break;
                        case 'image':
                        
                            break;
                        case 'date':
                        
                            break;
                        case 'datetime':
                        
                            break;
                        case 'true_false':
                        
                            break;                                          
                    }
                ?>
            <?php endforeach; ?>

            <div class="form-group">
                <?= Html::submitButton('SAVE', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php else: ?>
            <center>
                <font color="red">
                    Please create config file!
                </font>
            </center>
        <?php endif; ?>
    </div>

    <div class="col-lg-3">

    </div>
    <?php ActiveForm::end(); ?>

</div>
