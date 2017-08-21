<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;


class CambioController extends \yii\rest\Controller
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

    
    public function actionEuroReal()
    {
    	$url = 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22EURBRL=X%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
        $dataws = json_decode(file_get_contents($url));

        $data = array();
        $data['name'] = 'Câmbio Euro x Real';
        $data['source'] = 'Yahoo APIs v1';
        $data['price'] = ($dataws->query->results->quote->Ask);
        
        $superapi = new superapi();
        $superapi->return = $data;
    	
        return $superapi;
    }


    public function actionDolarReal()
    {
        $url = 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22USDBRL=X%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
        $dataws = json_decode(file_get_contents($url));

        $data = array();
        $data['name'] = 'Câmbio Dolar (USD) x Real';
        $data['source'] = 'Yahoo APIs v1';
        $data['price'] = ($dataws->query->results->quote->Ask);
        
        $superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;
    }





}	
