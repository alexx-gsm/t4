<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 06.05.2016
 * Time: 9:38
 */

namespace App\Controllers;


use T4\Mvc\Controller;

class Photo extends Controller
{
    public function actionDefault()
    {
        $this->data->extraTitle = $this->app->config->photo . ' | ';
    }
    
    public function actionLast()
    {
        $this->data->extraTitle = $this->app->config->photoLast . ' | ';
    }
}