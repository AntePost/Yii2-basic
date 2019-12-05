<?php

namespace app\controllers;

use \yii\web\Controller;
use \yii\helpers\Url;
use app\models\SignupForm;
use app\models\User;

class CalendarController extends Controller
{
    public function actionActivityView()
    {
        return $this->render('activityView');
    }

    public function actionAddActivity()
    {
        $model = new \app\models\ActivityForm();
    
        if ($model->load(\Yii::$app->request->post())) {
            if ($activity = $model->addActivityToDb()) {
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

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (\Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}