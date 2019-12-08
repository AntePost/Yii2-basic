<?php

namespace app\models;

use yii\base\Model;
use app\models\Activity;

class ActivityForm extends Model
{
    public $name;
    public $startedAt; // format Y-m-d h:m:s (1999-02-05 23:45:12)
    public $parsedDate;
    public $finishedAt;
    public $authorID;
    public $description;
    public $isRepeatable;
    public $isBlocking;

    public function rules()
    {
        return [
            [['name', 'startedAt', 'description'], 'required'],
            [['name', 'startedAt', 'finishedAt', 'description'], 'string'],
            [['isRepeatable', 'isBlocking'], 'boolean'],
            [['finishedAt'], 'checkFinishedAt', 'skipOnEmpty' => false, 'skipOnError' => false]
        ];
    }

    public function checkFinishedAt($attribute, $params, $validator)
    {
        var_dump($this->attribute);
        if (empty($this->attribute)) {
            $this->attribute = time();
        } elseif ($this->attribute < $this->startedAt) {
            $this->addError($attribute, 'The end date cannot be less than start date');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Activity name',
            'startedAt' => 'Activity start',
            'finishedAt' => 'Activity finish',
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
        preg_match('(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})', $this->startedAt, $matches);
        $this->parsedDate = array(
            'year' => $matches[1],
            'month' => $matches[2],
            'day' => $matches[3],
            'hour' => $matches[4],
            'minute' => $matches[5],
            'second' => $matches[6]
        );
    }

    public function addActivityToDb()
    {
        if (!$this->validate()) {
            return null;
        }
        $activity = new Activity();
        $activity->name = $this->name;
        $activity->startedAt = $this->started_at;
        $activity->finishedAt = $this->finished_at;
        $activity->authorID = 1;
        $activity->description = $this->description;
        $activity->isRepeatable = $this->is_repeatable;
        $activity->isBlocking = $this->is_blocking;
        return $activity->save() ? $activity : null;
    }
}