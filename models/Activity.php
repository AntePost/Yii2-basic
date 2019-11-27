<?php

namespace app\models;

use yii\base\Model;

class Activity extends Model
{
    private $name;
    private $date; // format Y-m-d h:m:s (1999-02-05 23:45:12)
    private $parsedDate;
    private $duration;
    private $authorID;
    private $description;
    private $isRepeatable;
    private $isBlocking;

    public function attributeLabels()
    {
        return [
            'name' => 'Activity name',
            'date' => 'Activity date',
            'duration' => 'Activity duration',
            'authorID' => 'Author ID',
            'description' => 'Activity description',
            'isRepeatable' => 'Can be repeated',
            'isBlocking' => 'No other activities in that time slot'
        ];
    }

    public function changeName($newName)
    {
        $this->name = $newName;

        if ($this->name === $newName) {
            return 'Ok';
        } else {
            return 'Error';
        }
    }

    public function parseDate()
    {
        preg_match('(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})', $this->date, $matches);
        $this->parsedDate = array(
            'year' => $matches[1],
            'month' => $matches[2],
            'day' => $matches[3],
            'hour' => $matches[4],
            'minute' => $matches[5],
            'second' => $matches[6]
        );
    }
}