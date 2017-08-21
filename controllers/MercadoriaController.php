<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;


class MercadoriaController extends \yii\rest\Controller
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

    
    public function actionConsulta($ean)
    {
    	$urlSource = 'https://cosmos.bluesoft.com.br/produtos/'.$ean;
       
        $domSource = new Dom;
        $domSource->loadFromUrl($urlSource);

        $data = array();
        $data['name'] = 'Dados EAN '. $ean;
        $data['source'] = 'cosmos.bluesoft.com.br';
        $data['ean'] = $ean;
        $data['descricao'] = 'Produto não encontrado';

        if((count($domSource->find('.page-header'))) > 0 )
        {
            $data['descricao'] = $domSource->find('.page-header')->text();
            $data['marca'] = $domSource->find('.brand-name a')->text();
            $data['ncm'] = $domSource->find('.ncm-name a')->text();
        }
        
        $superapi = new superapi();
        $superapi->return = $data;
    	
        return $superapi;
    }

}	
