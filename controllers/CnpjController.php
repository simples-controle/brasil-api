<?php
namespace app\controllers;

use SoapClient;
use PHPHtmlParser\Dom;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use app\models\CnpjCnaeSecundaria;
use app\models\Cnpj;
use app\models\Cnae;
use app\models\Config;
use Yii;
use yii\helpers\Url;



class CnpjController extends \yii\rest\Controller
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

    
    public function actionConsultaCnpj($cnpj)
    {
        $superapi = new superapi();
        $retorno = new \stdClass();
        $cnpjObj = Cnpj::find()->porCnpj(\Yii::$app->configComponent->maskCnpj($cnpj))->one();
        if(is_null($cnpjObj))
        {
            $url = "https://www.receitaws.com.br/v1/cnpj/" . $cnpj;
            $json_data = \Yii::$app->configComponent->curl(['url' => $url]);
            if( $json_data['status'] === "ERROR")
            {
                $superapi->return = $json_data;
                return $superapi;
            }
            else
            {
                $cnpjObj = new Cnpj;
                $cnpjObj->attributes = $json_data;
                if(count($json_data['atividade_principal'])==1)
                {
                    $codigo = \Yii::$app->configComponent->removeMascara($json_data['atividade_principal'][0]['code']);
                    $codigo = \Yii::$app->configComponent->mask($codigo, '####-#/##');
                    $cnae = Cnae::find()->porCodigo($codigo)->one();
                    if(is_null($cnae))
                    {
                        $cnae_new_p = new Cnae();
                        $cnae_new_p->codigo = $codigo;
                        $cnae_new_p->descricao = $json_data['atividade_principal'][0]['text'];
                        $cnae_new_p->save();
                        $cnpjObj->cnae_id = $cnae_new_p->id;
                    }else
                    {
                        $cnpjObj->cnae_id = $cnae->id;
                    }
                    $cnpjObj->extra = '';
                }
                
                if($cnpjObj->save())
                {
                    if(isset($json_data['atividades_secundarias']) && count($json_data['atividades_secundarias'])>0)
                    {
                        foreach ($json_data['atividades_secundarias'] as $key => $atividades_secundarias) 
                        {
                            $cnpjCnaeSecundaria = new CnpjCnaeSecundaria();
                            $cnpjCnaeSecundaria->cnpj_id = $cnpjObj->id;
                            $codigo = preg_replace('/[^a-z0-9]+/i', '', $atividades_secundarias['code']);
                            $codigo = \Yii::$app->configComponent->mask($codigo, '####-#/##');
                            $cnae_s = Cnae::find()->porCodigo($codigo)->one();
                            if(is_null($cnae_s))
                            {
                                $cnae_new = new Cnae();
                                $cnae_new->codigo = $codigo;
                                $cnae_new->descricao = $atividades_secundarias['text'];
                                $cnae_new->save();
                                $cnpjCnaeSecundaria->cnae_id = $cnae_new->id;
                            }else
                            {
                                $cnpjCnaeSecundaria->cnae_id = $cnae_s->id;
                            }
                            $cnpjCnaeSecundaria->save();
                        }
                    }
                }

                $retorno->dados = $cnpjObj;
                $retorno->atividade_principal = $cnpjObj->cnae;
                $retorno->atividades_secundarias = $cnpjObj->cnpjCnaeSecundarias;

                $superapi->return = $retorno;
                return $superapi;
            }
        }else
        {
            $retorno->dados = $cnpjObj;
            $retorno->atividade_principal = $cnpjObj->cnae;
            $retorno->atividades_secundarias = $cnpjObj->cnpjCnaeSecundarias;
            $superapi->return = $retorno;
            return $superapi;
        }
    }
}	
