<?php
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\Config;

class ConfigComponent extends Component
{
	public function getCosmosKey()
	{
		$config = Config::find()->one();
		if(!is_null($config))
		{
			return $config->cosmos_key;
		}else
		{
			$config = new Config;
			$config->cosmos_key = 'token';
			$config->data_criacao = date('Y-m-d');
			$config->data_atualizacao = date('Y-m-d');
			$config->save();
			return $config->cosmos_key;
		}
	}
}