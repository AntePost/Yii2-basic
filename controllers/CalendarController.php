<?php

namespace app\controllers;

use \yii\web\Controller;
use \yii\helpers\Url;

class CalendarController extends Controller
{
    public function actionActivityView()
    {
        return $this->render('activityView');
    }

    public function actionAddActivity()
    {
        $model = new \app\models\Activity();
    
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                return $this->redirect(Url::to('add-activity-submit'));
            }
        }
    
        return $this->render('addActivity', [
            'model' => $model,
        ]);
    }

    public function actionAddActivitySubmit()
    {
        return $this->render('addActivitySubmit');
    }
}