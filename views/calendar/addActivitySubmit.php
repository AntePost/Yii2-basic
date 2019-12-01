<?php

use yii\helpers\VarDumper;
if (\Yii::$app->request->isPost) {
    VarDumper::dump($_POST);
} else {
    echo 'Error';
}