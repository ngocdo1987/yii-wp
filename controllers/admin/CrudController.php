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

            $input = Yii::$app->request->post();

            // Check n-n
            if(isset($config->relation->nn) && count($config->relation->nn) > 0)
            {
                foreach($config->relation->nn as $singular_model => $v)
                {
                    $singular_model_ids = isset($input[$singular_model]) ? $input[$singular_model] : array();
                    $plural_model = $v->func;

                    //$sync = [];

                    if(!empty($singular_model_ids))
                    {
                        $singular_model_name = '\app\models\\'.ucfirst($singular_model);
                        $singular_model_name = new $singular_model_name;

                        $sync = $singular_model_name::find()->where(['id' => $singular_model_ids])->all();
                        //echo '<pre>'; print_r($sync); echo '</pre>'; die('');
                        if($sync)
                        {
                            foreach($sync as $s)
                            {
                                $model->link($plural_model, $s);
                            }
                        }
                    }
                }
            }

            //echo '<pre>'; print_r(Yii::$app->request->post()); echo '</pre>';
            //echo '<pre>'; print_r($model); echo '</pre>'; die('');

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

        // Check n-n
        if(isset($config->relation->nn) && count($config->relation->nn) > 0)
        {
            foreach($config->relation->nn as $singular_model => $v)
            {
                $singular_model_related_ids = $singular_model.'_related_ids';
                $$singular_model_related_ids = [];
                $plural_model = $v->func;

                if(!empty($model->$plural_model))
                {
                    foreach($model->$plural_model as $mp)
                    {
                        $$singular_model_related_ids[] = $mp->id;
                    }
                }

                $render_vars[$singular_model_related_ids] = $$singular_model_related_ids;
            }
        }

        //echo '<pre>'; print_r($model->getCategories()); echo '</pre>'; die('');

        $render_vars['model'] = $model;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $input = Yii::$app->request->post();

            // Check n-n
            if(isset($config->relation->nn) && count($config->relation->nn) > 0)
            {
                foreach($config->relation->nn as $singular_model => $v)
                {
                    $singular_model_ids = isset($input[$singular_model]) ? $input[$singular_model] : array();
                    $plural_model = $v->func;

                    // Delete old n-n
                    if(!empty($model->$plural_model))
                    {
                        foreach($model->$plural_model as $mpm)
                        {
                            $model->unlink($plural_model, $mpm, true);
                        }
                    }
                    //echo '<pre>'; print_r($model->$plural_model); echo '</pre>'; die('');

                    if(!empty($singular_model_ids))
                    {
                        $singular_model_name = '\app\models\\'.ucfirst($singular_model);
                        $singular_model_name = new $singular_model_name;

                        $sync = $singular_model_name::find()->where(['id' => $singular_model_ids])->all();
                        //echo '<pre>'; print_r($sync); echo '</pre>'; die('');
                        if($sync)
                        {
                            foreach($sync as $s)
                            {
                                $model->link($plural_model, $s);
                            }
                        }
                    }
                }
            }
            
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