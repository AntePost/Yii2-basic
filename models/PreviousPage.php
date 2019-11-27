<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PreviousPage extends Model
{
    public function SavePreviousPage()
    {
        $session = Yii::$app->session;

        $session->open();
        $session['previousPage'] = Yii::$app->request->referrer;
        $session->close();
    }
}