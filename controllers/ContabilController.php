<?php
namespace app\controllers;

use yii\rest\ActiveController;

class ApiContabilController extends \yii\rest\Controller
{
    
    public function actionIndex()
    {
    	return 'Essa API não tem metodo padrão, por favor verificar documentação da API.';
    }


    public function actionCrt(  )
    {
    	$data = [
    		['codigo' => '1', 'nome' => 'SIMPLES NACIONAL'],
    		['codigo' => '2', 'nome' => 'SIMPLES NACIONAL – EXCESSO DE SUBLIMITE DE RECEITA BRUTA'],
    		['codigo' => '3', 'nome' => 'REGIME NORMAL']

    	];
    	$superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;
    }

    public function actionCrt(  )
    {
        $data = [
            ['codigo' => '1', 'nome' => 'SIMPLES NACIONAL'],
            ['codigo' => '2', 'nome' => 'SIMPLES NACIONAL – EXCESSO DE SUBLIMITE DE RECEITA BRUTA'],
            ['codigo' => '3', 'nome' => 'REGIME NORMAL']

        ];
        $superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;
    }
    
}	
