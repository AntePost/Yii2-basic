<?php

namespace app\models;

use yii\base\Model;

class Day extends Model
{
    private $date; // format Y-m-d (1999-02-05)
    private $isWeekend;
    private $assocActivities;

    public function setIsWeekend()
    {
        $dayOfWeek = date('w', strtotime($this->date));

        if ($dayOfWeek === 0 || $dayOfWeek === 6) {
            $this->isWeekend = true;
        } else {
            $this->isWeekend = false;
        }
    }
}