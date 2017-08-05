<?php
namespace app\controllers;
use SoapClient;
use yii\rest\ActiveController;
use PHPHtmlParser\Dom;

class CorreiosController extends \yii\rest\Controller
{
    
    public function actionIndex()
    {
    	return 'Essa API não tem metodo padrão, por favor verificar documentação da API.';
    }


    public function actionConsultaCep($cep)
    {
        // fazendo consulta correios e obtendo a tabela de resposta
        $urlSource = 'http://viacep.com.br/ws/'.$cep.'/json/';     
        $queryReturn = json_decode( file_get_contents($urlSource) );

        $data = array();
        $data['name'] = 'CEP';
        $data['source'] = 'Vários';
        $data['cep'] = $queryReturn->cep;
        $data['logradouro'] = $queryReturn->logradouro;
        $data['complemento'] = $queryReturn->complemento;
        $data['bairro'] = $queryReturn->bairro;
        $data['localidade'] = $queryReturn->localidade;
        $data['uf'] = $queryReturn->uf;
        $data['codigo_ibge'] = $queryReturn->ibge;
        $data['codigo_uf_ibge'] = substr($queryReturn->ibge,0,2);
        
        $superapi = new superapi();
        $superapi->return = $data;
        
        return $superapi;

    }


    /**
     * 
     * Funcao rastrear Objetos dos correios - via http://sooho.com.br/2017/03/24/rastreamento-de-pedidos-correios-php-soap/
     *
     * @param string - Codigo fornecido pelos correios
     * @return object
     */
    public function actionRastrear( $objeto )
    {
       //@var string - URL dos correios para obter dados
       $__wsdl = "http://webservice.correios.com.br/service/rastro/Rastro.wsdl";

       //@var array - a ser usado com parametro para 1 objeto
       $_buscaEventos = array(
          'usuario'   => 'ECT',
          'senha'     => 'SRO',
          'tipo'      => 'L',
          'resultado' => 'T',
          'lingua'    => '101'
       );
       $_buscaEventos['objetos'] = $objeto;

       // criando objeto soap a partir da URL
       $client = new SoapClient( $__wsdl );
       $r = $client->buscaEventos( $_buscaEventos );

       // sempre retorna objeto por padrao
       var_dump($r->return->objeto);
    }



    
}	
