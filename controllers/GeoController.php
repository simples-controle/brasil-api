<?php
namespace app\controllers;

use yii\rest\ActiveController;
use PHPHtmlParser\Dom;
use sururulab\BrasilHelper\BrasilHelper;

class GeoController extends \yii\rest\Controller
{
    
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






