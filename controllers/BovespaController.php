<?php
namespace app\controllers;

use yii\rest\ActiveController;

class BovespaController extends \yii\rest\Controller
{
    
    public function actionIndex()
    {
    	return 'Essa API não tem metodo padrão, por favor verificar documentação da API.';
    }

    private function query($symbol)
    {
    	$url = 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22'.$symbol.'%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
        $dataws = json_decode(file_get_contents($url));

        $data = array();
        $data['name'] = 'COTAÇÃO BOVESPA '.$symbol;
        $data['source'] = 'YAHOO APIs v1';
        $data['price'] = ($dataws->query->results->quote->Ask);
        
        $superapi = new superapi();
        $superapi->return = $data;
    	
        return $superapi;
    }

    public function actionPetr3()
    {
        return $this->query('PETR3.SA');
    }

    public function actionPetr4()
    {
        return $this->query('PETR4.SA');
    }

    public function actionTots3()
    {
        return $this->query('TOTS3.SA');
    }

    public function actionVale3()
    {
        return $this->query('VALE3.SA');
    }

    public function actionElet3()
    {
        return $this->query('ELET3.SA');
    }

    public function actionElet6()
    {
        return $this->query('ELET6.SA');
    }

    public function actionVale5()
    {
        return $this->query('VALE5.SA');
    }

    public function actionBbas3()
    {
        return $this->query('BBAS3.SA');
    }

    public function actionBbdc3()
    {
        return $this->query('BBDC3.SA');
    }

    public function actionBbdc4()
    {
        return $this->query('BBDC4.SA');
    }
}	
