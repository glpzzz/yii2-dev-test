<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property int $seller_id
 * @property int $buyer_id
 * @property int $number
 * @property int $date
 * @property double $amount
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Client $buyer
 * @property Client $seller
 */
class Contract extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_id', 'buyer_id', 'number', 'amount', 'date', 'description'], 'required'],
            [['seller_id', 'buyer_id', 'number'], 'integer'],
            [['date'], 'date', 'format' => 'medium', 'timestampAttribute' => 'date'],
            [['number'], 'unique'],
            [['amount'], 'number'],
            [['buyer_id', 'seller_id'], 'ensureBuyerDifferentToSeller'],
            [['description'], 'string'],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['buyer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    public function ensureBuyerDifferentToSeller($attribute)
    {
        if($this->buyer_id == $this->seller_id){
            $this->addError($attribute, Yii::t('app', 'Buyer must be different to seller.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seller_id' => Yii::t('app', 'Seller'),
            'buyer_id' => Yii::t('app', 'Buyer'),
            'number' => Yii::t('app', 'Number'),
            'date' => Yii::t('app', 'Date'),
            'amount' => Yii::t('app', 'Amount'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(Client::class, ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Client::class, ['id' => 'seller_id']);
    }

    /**
     * {@inheritdoc}
     * @return ContractQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContractQuery(get_called_class());
    }
}
