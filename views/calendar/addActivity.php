<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form ActiveForm */
?>
<div class="calendar-addActivity">
    <?php $form = ActiveForm::begin([
        'action' => Url::to('/calendar/add-activity-submit'),
        'method' => 'post',
    ]); ?>
        <div class="form-group">
            <?php echo $form->field($model, 'name')->textInput();
            echo $form->field($model, 'date')->textInput();
            echo $form->field($model, 'duration')->textInput();
            echo $form->field($model, 'description')->textArea();
            echo $form->field($model, 'isRepeatable')->checkbox();
            echo $form->field($model, 'isBlocking')->checkbox();
            echo Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- calendar-addActivity -->
