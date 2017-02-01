<?php
	use yii\helpers\Html;

	$this->title = 'Edit '.$singular;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
