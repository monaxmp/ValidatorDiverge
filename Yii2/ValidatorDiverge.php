<?php

namespace app\models;


class ValidatorDiverge  implements DivergeInterface
{
    private $allowDiverge = 10;
    private $resultDeviation;
    public $out;
    public $new;

    /**
     * Отклонение цены не должно быть больше допустимого значения (%)
     *
     * @param float $new новая цена, которую будем проверять на отклонение.
     * @param float $out текущая цена.
     * @return bool
     */
    public function diffPrice(float $new, float $out): bool
    {
        $this->out = $out;
        $this->new = $new;

        if (is_null($new) || is_null($out)) return false;
        if (($new < 0) || ($out < 0)) return false;

        $deviation = $this->getDeviation();

        if ($this->allowDiverge >= $deviation) {
            return true;
        }

        return false;

    }

    /**
     * Результат отклонения в %
     *
     * @return float
     */
    public function getDeviation(): float
    {
        $this->resultDeviation = abs((($this->out - $this->new) / $this->out) * 100);

        return $this->resultDeviation;

    }

}
