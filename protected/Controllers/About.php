<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 06.05.2016
 * Time: 9:30
 */

namespace App\Controllers;


use T4\Mvc\Controller;

class About extends Controller
{
    public function actionDefault()
    {
        $this->data->extraTitle = $this->app->config->about . ' | ';
    }
}