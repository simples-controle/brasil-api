<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

use sururulab\BrasilHelper\BrasilHelper;

class FinanceiroController extends \yii\rest\Controller
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


    public function actionBancos()
    {
        $data = array();
        $data['name'] = 'BANCOS BRASILEIROS';
        $data['source'] = 'IBGE';
        $data['bancos'] =  BrasilHelper::bancosBrasileiros();

        $superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;
        
    }

  

    
}	






