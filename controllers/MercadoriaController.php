<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use app\models\Produto;
use app\models\Config;
use Yii;
use yii\helpers\Url;



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
        $url = Url::home(true);
        $produto = new Produto;
        $produto = $produto->find()->porEan($ean)->one();
        $superapi = new superapi();

        if(is_null($produto))
        {
            $config = \Yii::$app->configComponent->getCosmosKey();
            $urlJson = "https://api.cosmos.bluesoft.com.br/gtins/" . $ean;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlJson);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
             'X-Cosmos-Token: '. $config));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $json_data = curl_exec($ch);
            curl_close($ch);
            $json_data = json_decode($json_data, true);

            if( isset( $json_data['message']) == "Token Inválido")
            {
                $superapi->return = $json_data;
                return $superapi->return;
            }
            elseif(isset($json_data['message']) !=="O recurso solicitado não existe" )
            {
                $produto = new Produto;
                $produto = $produto->salvarProduto($json_data);
                $produto->imagem_produto = $url . $produto->imagem_produto;
                $produto->imagem_codigo_barras = $url . $produto->imagem_codigo_barras;
                if(!is_null($produto->imagem_marca))
                {
                    $produto->imagem_marca = $url . $produto->imagem_marca;
                }
                $superapi->return = $produto;
                return $superapi;
                
            }else
            {   
                $superapi->return = $json_data['message'];
                return $superapi->return;
            }
        }else
        { 
            $produto->imagem_produto = $url . $produto->imagem_produto;
            $produto->imagem_codigo_barras = $url . $produto->imagem_codigo_barras;
            if(!is_null($produto->imagem_marca))
            {
                $produto->imagem_marca = $url . $produto->imagem_marca;
            }
            $superapi->return = $produto;
            return $superapi;
        }
    }
    public function actionConsultaNcms($ncm)
    {
        $config = Config::find()->one();
        $urlJson = "https://api.cosmos.bluesoft.com.br/ncms/" . $ncm .'/products' ;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlJson);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
         'X-Cosmos-Token: '. $config->cosmos_key));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $json_data = curl_exec($ch);
        curl_close($ch);
        $json_data = json_decode($json_data, true);
        return $json_data;
    }
}	
