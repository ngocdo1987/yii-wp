<?php
	use yii\helpers\Html;
	use yii\grid\GridView;

	$this->title = 'List '.$plural;
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a('<i class="fa fa-plus"></i> ADD NEW', ['create'], ['class' => 'btn btn-primary']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $columns,
]); ?>

