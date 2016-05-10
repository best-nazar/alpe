<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Productoptions]].
 *
 * @see Productoptions
 */
class ProductoptionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Productoptions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Productoptions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
