<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Contract]].
 *
 * @see Contract
 */
class ContractQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Contract[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Contract|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
