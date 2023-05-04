<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\ValidatorDiverge;


class Price extends Model
{

    public $priceOut;
    public $priceNew;

    /**
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            ['priceNew', 'ValidatorDiverge', 'min' => 0],
            ['priceOut', 'double', 'min' => 0],
        ];
    }

    /**
     * @return bool|void
     */
    public function ValidatorDiverge(): bool
    {
        $ValidatorDiverge = new ValidatorDiverge();
        return $ValidatorDiverge->diffPrice($this->pricenew, $this->priceOut);
    }

}
