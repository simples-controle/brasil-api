<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;


class BitcoinController extends \yii\rest\Controller
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

    
    private function query($moeda)
    {
    	$urlSource = 'https://fx-rate.net/BTC/'.$moeda.'/';
       
        $domSource = new Dom;
        $domSource->loadFromUrl($urlSource);

        $data = array();
        $data['name'] = 'Taxa BTC x '. $moeda;
        $data['source'] = 'fx-rate.net/BTC/'.$moeda.'/';
        $data['price'] = $domSource->find('.cal_amount_to')->value/1000;
        
        $superapi = new superapi();
        $superapi->return = $data;
    	
        return $superapi;
    }

    public function actionBitcoinDolar()
    {
        return $this->query('USD');
    }

    public function actionBitcoinReal()
    {
        return $this->query('BRL');
    }

    public function actionBitcoinEuro()
    {
        return $this->query('EUR');
    }

    public function actionBitcoinYen()
    {
        return $this->query('JPY');
    }

    public function actionBitcoinPesoArgentino()
    {
        return $this->query('ARS');
    }








}	
