<?php
namespace app\controllers;

use yii\rest\ActiveController;
use PHPHtmlParser\Dom;
use sururulab\BrasilHelper\BrasilHelper;

class FinanceiroController extends \yii\rest\Controller
{
    
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






