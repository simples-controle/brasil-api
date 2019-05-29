<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $gtin
 * @property string $ean
 * @property string $imagem_produto
 * @property string $preco
 * @property string $preco_medio
 * @property string $preco_maximo
 * @property string $preco_minimo
 * @property string $largura
 * @property string $altura
 * @property string $comprimento
 * @property string $peso_liquido
 * @property string $peso_bruto
 * @property string $imagem_codigo_barras
 * @property string $marca_nome
 * @property string $imagem_marca
 * @property string $gpc_codigo
 * @property string $gpc_descricao
 * @property string $tipo_embalagem
 * @property string $quantidade_embalagem
 * @property string $ncm_codigo
 * @property string $ncm_descricao
 * @property string $cest_codigo
 * @property string $cest_descricao
 * @property string $fabricante_nome
 * @property string $base_origem
 * @property int $data_criacao
 * @property int $data_atualizacao
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'imagem_produto', 'preco', 'preco_medio', 'preco_maximo', 'preco_minimo', 'largura', 'altura', 'comprimento', 'peso_liquido', 'peso_bruto', 'imagem_codigo_barras', 'marca_nome', 'imagem_marca', 'gpc_codigo', 'gpc_descricao', 'tipo_embalagem', 'quantidade_embalagem', 'ncm_codigo', 'ncm_descricao', 'cest_codigo', 'cest_descricao', 'fabricante_nome', 'base_origem'], 'string'],
            [['data_criacao', 'data_atualizacao'], 'required'],
            [['data_criacao', 'data_atualizacao'], 'string'],
            [['nome'], 'string', 'max' => 255],
            [['ean'], 'string', 'max' => 500],
            [['nome'], 'unique'],
            [['ean'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'ean' => 'Ean',
            'imagem_produto' => 'Imagem Produto',
            'preco' => 'Preco',
            'preco_medio' => 'Preco Medio',
            'preco_maximo' => 'Preco Maximo',
            'preco_minimo' => 'Preco Minimo',
            'largura' => 'Largura',
            'altura' => 'Altura',
            'comprimento' => 'Comprimento',
            'peso_liquido' => 'Peso Liquido',
            'peso_bruto' => 'Peso Bruto',
            'imagem_codigo_barras' => 'Imagem Codigo Barras',
            'marca_nome' => 'Marca Nome',
            'imagem_marca' => 'Imagem Marca',
            'gpc_codigo' => 'Gpc Codigo',
            'gpc_descricao' => 'Gpc Descricao',
            'tipo_embalagem' => 'Tipo Embalagem',
            'quantidade_embalagem' => 'Quantidade Embalagem',
            'ncm_codigo' => 'Ncm Codigo',
            'ncm_descricao' => 'Ncm Descricao',
            'cest_codigo' => 'Cest Codigo',
            'cest_descricao' => 'Cest Descricao',
            'fabricante_nome' => 'Fabricante Nome',
            'base_origem' => 'Base Origem',
            'data_criacao' => 'Data Criacao',
            'data_atualizacao' => 'Data Atualizacao',
        ];
    }

    public function salvarProduto($json_data)
    {
        $this->nome = $json_data['description'] .' '. (string) $json_data['net_weight'];
        $this->ean = (string) $json_data['gtin'];
        $this->imagem_produto = $json_data['thumbnail'];
        $this->preco = $json_data['price'];
        $this->preco_medio = (string)$json_data['avg_price'];
        $this->preco_maximo = (string)$json_data['max_price'];
        $this->preco_minimo = (string)$json_data['min_price'];
        $this->largura = (string)$json_data['width'];
        $this->altura = (string)$json_data['height'];
        $this->comprimento = (string)$json_data['length'];
        $this->peso_liquido = (string) $json_data['net_weight'];
        $this->peso_bruto = (string) $json_data['gross_weight'];
        $this->imagem_produto = $this->salvarImagem($json_data['thumbnail'], 'produto_img');
        $this->imagem_codigo_barras = $this->salvarImagem($json_data['barcode_image'], 'codigo_barras_img');


        if(isset($json_data['brand']))
        {
            $this->marca_nome = $json_data['brand']['name'];
            if($json_data['brand']['picture'] !== "")
            {
                $this->imagem_marca = $this->salvarImagem($json_data['brand']['picture'], 'marca_img');
            }
        }

        if(isset($json_data['gpc']))
        {
            $this->gpc_codigo = $json_data['gpc']['code'];
            $this->gpc_descricao = $json_data['gpc']['description'];
        }

        if(isset($json_data['gtins']))
        {
            $this->quantidade_embalagem = (string) $json_data['gtins'][0]['commercial_unit']['quantity_packaging'];
            $this->tipo_embalagem = $json_data['gtins'][0]['commercial_unit']['type_packaging'];
        }

        if(isset($json_data['ncm']))
        {
            $this->ncm_codigo = $json_data['ncm']['code'];
            $this->ncm_descricao = $json_data['ncm']['description'];
        }

        if(isset($json_data['cest']))
        {
            $this->cest_codigo = $json_data['cest']['code'];
            $this->cest_descricao = $json_data['cest']['description'];
        }

        $this->base_origem = "cosmos";
        $this->data_criacao = date('Y-m-d');
        $this->data_atualizacao = date('Y-m-d');
        if($this->save())
        {
            return $this;
        }else
        {
            return 'Erro ao salvar produto';
        }
    }

    public function salvarImagem($url, $pasta='produto_img')
    {
        $extension = null;
        if($pasta == 'marca_img')
        {
            $nome_arquivo = null;
            $nome_arquivo = str_replace(' ', '_', strtolower($this->marca_nome));
            $nome_arquivo = str_replace('-', '_', $nome_arquivo);
            $nome_arquivo = str_replace('/', '_', $nome_arquivo);
        }else
        {   
            $nome_arquivo = null;
            $nome_arquivo = str_replace(' ', '_', strtolower($this->nome));
            $nome_arquivo = str_replace('-', '_', $nome_arquivo);
            $nome_arquivo = str_replace('/', '_', $nome_arquivo);
        }
        

        $file_parts = pathinfo($url);
        switch(isset($file_parts['extension']))
        {
            case "jpg":
            $extension =  $file_parts['extension'];
            break;

            case "png":
            $extension =  $file_parts['extension'];
            break;

            case "":
            $extension = "JPEG";
            break;
            case NULL:
            break;
        }

        $nome_arquivo = $nome_arquivo. '.' . $extension;
        $url_local = \Yii::getAlias('@app').'/web/'.$pasta.'/';
        if (!file_exists($url_local)) {
            mkdir($url_local, 0777, true);
        }
        $url_local = $url_local . $nome_arquivo;
        $ch = curl_init($url);
        $fp = fopen($url_local, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        return $pasta.'/'. $nome_arquivo; 
    }

    public static function find()
    {
        return new ProdutoQuery(get_called_class());
    }
}
