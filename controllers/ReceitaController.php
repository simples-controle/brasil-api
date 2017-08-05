<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;


class ReceitaController extends \yii\rest\Controller
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


    private function rastrearPacote($pacote)
{
    // fazendo consulta correios e obtendo a tabela de resposta
    $urlSource = 'http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI='.$pacote;     

    $domSource = new Dom;
    $domSource->loadFromUrl($urlSource);
    $html = $domSource->find('table tr');

    // percorrendo as trs do html pra ir montando o retorno
    $i=-1;
    $dataReturn = array();
    foreach ($html as $row) 
    {
        // para cada tr, pega-se seus tds e preenche
        $td = $row->find('td');
        if(count($td)>1)
        {
            $dataRegister = new stdClass;
            $dataRegister->dataHora = utf8_encode($td[0]->text);
            $dataRegister->local = utf8_encode($td[1]->text);
            $situacao = $td[2];
            $dataRegister->situacao = utf8_encode($situacao->find('font')->text);
            $dataRegister->observacao = '';
            $i++;
            $dataReturn[$i] = $dataRegister;
        }
        else
        {
            $dataReturn[$i]->observacao = utf8_encode($td[0]->text);
        }   
    }

    // remove o cabecaho do html (pego acidentalmente no algoritimo acima, rever depois)
    unset($dataReturn[0]);

    return $dataReturn;
    }

}
    
}	
