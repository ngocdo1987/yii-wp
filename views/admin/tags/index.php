<?php
	use yii\helpers\Html;
	use yii\grid\GridView;

	$this->title = 'List tags';
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'tag_name',
        'tag_description',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

<p>
    <?= Html::a('ADD NEW', ['create'], ['class' => 'btn btn-primary']) ?>
</p>