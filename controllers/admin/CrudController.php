<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CrudController extends Controller
{
	protected $singular;
	protected $plural;
	protected $config;

	public $layout = 'admin';

	public function init()
    {
        parent::init();

        $cfg_file = '../config/cms/'.$this->singular.'.json';
		$config = file_exists($cfg_file) ? json_decode(file_get_contents($cfg_file)) : null;

		$this->config = $config;
    }

	public function actionIndex()
    {
    	$config = $this->config;
    	$searchModel = '\app\models\\'.ucfirst($this->singular).'Search';

        $searchModel = new $searchModel;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $columns = [];
        if(isset($config->display->index) && count($config->display->index) > 0)
        {
        	foreach($config->display->index as $cdi)
        	{
        		$columns[] = $cdi;
        	}
        }
        $columns[] = ['class' => 'yii\grid\ActionColumn'];

        return $this->render('/admin/crud/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'plural' => $this->plural,
            'columns' => $columns
        ]);
    }

    public function actionView($id)
    {
    	$config = $this->config;
    	$attributes = [];

    	if(isset($config->cols) && count($config->cols) > 0)
    	{
    		foreach($config->cols as $k => $v)
    		{
    			$attributes[] = $k;
    		}
    	}

        return $this->render('/admin/crud/view', [
            'model' => $this->findModel($id),
            'singular' => $this->singular,
            'attributes' => $attributes
        ]);
    }

    public function actionCreate()
    {
        $config = $this->config;

        $render_vars = [
            'singular' => $this->singular,
            'config' => $config
        ];

        // Check recursive
        if(isset($config->recursive) && $config->recursive == 1)
        {

        }

        // Check 1-n

        // Check n-n
        if(isset($config->relation->nn) && count($config->relation->nn) > 0)
        {
            foreach($config->relation->nn as $singular_model => $v)
            {
                $model = '\app\models\\'.ucfirst($singular_model);
                $render_vars[$singular_model] = $model::find()->all();
            }
        }

    	$model = '\app\models\\'.ucfirst($this->singular);
        $model = new $model;

        $render_vars['model'] = $model;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/admin/crud/create', [
                'render_vars' => $render_vars
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $config = $this->config;

        $render_vars = [
            'singular' => $this->singular,
            'config' => $config 
        ];

        // Check recursive
        if(isset($config->recursive) && $config->recursive == 1)
        {

        }

        // Check 1-n

        // Check n-n
        if(isset($config->relation->nn) && count($config->relation->nn) > 0)
        {
            foreach($config->relation->nn as $singular_model => $v)
            {
                $model = '\app\models\\'.ucfirst($singular_model);
                $render_vars[$singular_model] = $model::find()->all();
            }
        }

        $model = $this->findModel($id);
        $render_vars['model'] = $model;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/admin/crud/update', [
                'render_vars' => $render_vars
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
    	$model = '\app\models\\'.ucfirst($this->singular);
    	$model = new $model;

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}