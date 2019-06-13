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

	public function curl($params = [])
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $params['url']);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$json_data = curl_exec($ch);
		curl_close($ch);
		$json_data = json_decode($json_data, true);
		return $json_data;
	}

	function mask($val, $mask)
	{
		$maskared = '';
		$k        = 0;
		for ($i = 0; $i <= strlen($mask) - 1; $i++) {
			if ($mask[$i] == '#') {
				if (isset($val[$k]))
					$maskared .= $val[$k++];
			} else {
				if (isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}

	public function removeMascara($dado)
	{
		return preg_replace('/[^a-z0-9]+/i', '', $dado);
	}

	public function maskCnpj($cnpj)
	{
		return $this->mask($cnpj, '##.###.###/####-##');
	}
}