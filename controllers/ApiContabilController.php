<?php
namespace app\controllers;

use yii\rest\ActiveController;

class ApiContabilController extends \yii\rest\Controller
{
    
    public function actionIndex()
    {
    	return 'oi';
    }


    public function actionCrt($s)
    {
    	$data = [
    		['codigo' => '1', 'nome' => 'SIMPLES NACIONAL'],
    		['codigo' => '2', 'nome' => 'SIMPLES NACIONAL – EXCESSO DE SUBLIMITE DE RECEITA BRUTA'],
    		['codigo' => '3', 'nome' => 'REGIME NORMAL']

    	];
    	return $data;
    }
    
}	
