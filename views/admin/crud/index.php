<?php
	use yii\helpers\Html;
	use yii\grid\GridView;

	$this->title = 'List '.$plural;
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $columns,
]); ?>

<p>
    <?= Html::a('ADD NEW', ['create'], ['class' => 'btn btn-primary']) ?>
</p>