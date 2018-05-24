<?php
/**
 * Created by PhpStorm.
 * User: glpz
 * Date: 23/05/18
 * Time: 11:46
 */

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BaseActiveRecord extends ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

}