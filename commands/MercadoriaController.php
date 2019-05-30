<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use yii\helpers\BaseConsole;
use yii\console\Controller;
use app\models\Produto;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MercadoriaController extends Controller
{
	private function out($text){
		$this->stderr(date('d/m/Y h:i:s') . ' - ' . $text);
		BaseConsole::output('');
	}

	private function breakline(){
		BaseConsole::output('');
		BaseConsole::output('');
		BaseConsole::output('');
	}
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionImportarMercadorias()
    {
    	$this->out('Inserindo Produtos');
    	$file= \Yii::getAlias('@app').'/data/produto_csv/produtos.csv';	
    	$this->out('lendo arquivo '.$file.'...');
        $array = [];
        if(file_exists($file))
        {
            $row = 1;
            if (($handle = fopen($file, "r")) !== FALSE) 
            {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
                {

                    $num = count($data);
                    $row++;
                    for ($c=0; $c < $num; $c++) {
                        $array[$row][$c] = $data[$c];
                    }
                }
                fclose($handle);
                $nomes = array_shift($array);
            }
            if(count($array)>0){
                foreach ($array as $item) 
                {
                 $produto = new Produto;
                 $produto->nome = $item[0]; 
                 $produto->ean = $item[1];  
                 $produto->preco = $item[2]; 
                 $produto->largura = $item[3]; 
                 $produto->altura = $item[4]; 
                 $produto->comprimento = $item[5]; 
                 $produto->peso_liquido = $item[6]; 
                 $produto->peso_bruto = $item[7]; 
                 $produto->marca_nome = $item[8]; 
                 $produto->ncm_codigo = $item[9]; 
                 $produto->cest_codigo = $item[10]; 
                 $produto->cest_descricao = $item[11]; 
                 $produto->ncm_descricao = $item[12]; 
                 $produto->base_origem = $item[13]; 
                 $produto->data_criacao = date('Y-m-d'); 
                 $produto->data_atualizacao = date('Y-m-d');
                 if($produto->save()){
                    $this->out('Produto ' . $produto->nome . ' salvo!' );
                }
            }
        }
        $this->out('Finzalizando importacao');
    }
    else
    {
      $this->out('<ERROR> ARQUIVO NAO ENCONTRADO');
  }
}
}
