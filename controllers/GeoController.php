<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

use sururulab\BrasilHelper\BrasilHelper;

class GeoController extends \yii\rest\Controller
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


    public function actionEstados()
    {
        $data = array();
        $data['name'] = 'ESTADOS BRASILEIROS';
        $data['source'] = 'IBGE';
        $data['estados'] =  BrasilHelper::estados();

        $superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;
        
    }

  

    
}	






