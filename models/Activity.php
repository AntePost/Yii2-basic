<?php

namespace app\models;

use yii\base\Model;

class Activity extends Model
{
    public $name;
    public $date; // format Y-m-d h:m:s (1999-02-05 23:45:12)
    public $parsedDate;
    public $duration;
    public $authorID;
    public $description;
    public $isRepeatable;
    public $isBlocking;

    public function rules()
    {
        return [
            [['name', 'date', 'duration', 'description'], 'required'],
            [['name', 'date', 'duration', 'description'], 'string'],
            [['isRepeatable', 'isBlocking'], 'boolean']
        ];
    }

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