<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cnpj]].
 *
 * @see Cnpj
 */
class CnpjQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cnpj[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cnpj|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function porCnpj($cnpj)
    {
        return $this->andFilterWhere(['=', 'cnpj.cnpj', $cnpj]);
    }
}
