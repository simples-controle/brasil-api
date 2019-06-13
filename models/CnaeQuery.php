<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cnae]].
 *
 * @see Cnae
 */
class CnaeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cnae[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cnae|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function porCodigo($cnae)
    {
        return $this->andFilterWhere(['=', 'cnae.codigo', $cnae]);
    }
}
