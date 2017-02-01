<?php
	use yii\helpers\Html;

	$this->title = 'Add '.$singular;
?>

<?= $this->render('_form', [
	'model' => $model,
	'config' => $config
]) ?>
