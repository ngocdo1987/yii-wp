<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;

    $this->title = 'View tag';
?>
<div class="row">
    <div class="col-lg-9">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'tag_name',
                'tag_slug',
                'tag_description',
                'tag_mt',
                'tag_md',
                'tag_mk',
                'created_at',
                'updated_at',
            ],
        ]) ?>
    </div>

    <div class="col-lg-3">

    </div>
</div>