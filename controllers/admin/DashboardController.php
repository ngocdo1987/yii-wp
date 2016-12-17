<?php

namespace app\controllers\admin;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class DashboardController extends Controller
{
	public $layout = 'admin';

	public function actionIndex()
	{
		return $this->render('index', []);
	}
}