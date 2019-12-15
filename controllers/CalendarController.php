<?php

namespace app\controllers;

use \yii\web\Controller;
use \yii\helpers\Url;
use app\models\SignupForm;
use app\models\User;
use app\models\search\ActivitySearch;
use app\models\Activity;
use edofre\fullcalendar\models\Event;

class CalendarController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEvents($id, $start, $end)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (\Yii::$app->user->isGuest) {
            return ['status' => false]; // TODO сделать вывод сообщения об ошибке, если пользователь не залогинен.
        } else {
            $events = Activity::findAll(['user_id' => \Yii::$app->user->id]);
        }

        $result = [];
        foreach ($events as $event) {
            /** @var Activity  $event */
            $result[] = new Event([
                'id' => $event->id,
                'title' => $event->name,
                'start' => \Yii::$app->formatter->asDatetime($event->started_at, 'php:c'),
                'end' => \Yii::$app->formatter->asDatetime($event->finished_at, 'php:c'),
                'editable' => false,
                'startEditable' => false,
                'durationEditable' => false,
                'color' => 'red',
                'url' => Url::to(['activity/view', 'id' => $event->id])
            ]);
        }

        return $result;
    }

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