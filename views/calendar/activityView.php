<?php

use yii\helpers\Html;

$this->title = 'Activity View';
?>

<div class="calendar-activityView">
    <h1><?= Html::encode($this->title) ?></h1>
    <a href="#">Back to calendar</a>
    <br>
    <a href="#">Edit activity</a>
    
    <div class="activity-display">
        <h2>Activity name</h2>
        <p>Activity date is 2019.11.27</p>
        <p>Activity lasts 2 days</p>
        <p>Activity was created by User</p>
        <p>This is the description</p>
        <p>This activity can be repeated</p>
        <p>This activity blocks all other activities</p>
    </div>
</div>