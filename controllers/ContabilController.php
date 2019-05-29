<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;


class ContabilController extends \yii\rest\Controller
{
    
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }
        
    public function actionIndex()
    {
    	return 'Essa API não tem metodo padrão, por favor verificar documentação da API.';
    }


    public function actionCrt(  )
    {
    	$data = 
        [
    		['codigo' => '1', 'nome' => 'SIMPLES NACIONAL'],
    		['codigo' => '2', 'nome' => 'SIMPLES NACIONAL – EXCESSO DE SUBLIMITE DE RECEITA BRUTA'],
    		['codigo' => '3', 'nome' => 'REGIME NORMAL']

    	];
    	$superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;
    }

    
}	
