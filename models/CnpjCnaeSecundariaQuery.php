<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CnpjCnaeSecundaria]].
 *
 * @see CnpjCnaeSecundaria
 */
class CnpjCnaeSecundariaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CnpjCnaeSecundaria[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CnpjCnaeSecundaria|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
