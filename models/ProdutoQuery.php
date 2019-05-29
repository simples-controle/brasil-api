<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Produto]].
 *
 * @see Produto
 */
class ProdutoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Produto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Produto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function porEan($ean)
    {
        return $this->andFilterWhere(['=', 'produto.ean', $ean]);
    }
}
