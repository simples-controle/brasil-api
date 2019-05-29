<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;


class TempoController extends \yii\rest\Controller
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

    private function queryAgora($cidade)
    {
        $urlSource = 'https://www.climatempo.com.br/previsao-do-tempo/cidade/'.$cidade;

        $domSource = new Dom;
        $domSource->loadFromUrl($urlSource);
        
        $data = array();
        $data['name'] = 'TEMPO AGORA EM ' . $cidade;
        $data['source'] = 'www.climatempo.com.br';
        $data['temperatura'] = $domSource->find('#momento-temperatura')->text();
        $data['sensacao'] = $domSource->find('#momento-sensacao')->text();
        $data['condicao'] = $domSource->find('#momento-condicao')->text();
        $data['pressao'] = $domSource->find('#momento-pressao')->text();
        $data['humidade'] = $domSource->find('#momento-humidade')->text();
        $data['atualizacao'] = $domSource->find('#momento-atualizacao')->text();
        
        $superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;

    }

    public function actionAgora($cidade)
    {
        return $this->queryAgora($cidade);
    }

  

    
}	






