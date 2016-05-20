<?php

namespace App\Controllers;


use T4\Mvc\Controller;

class Product extends Controller
{
    public function actionDefault()
    {
        $item = \App\Models\Product::findByPk(1);
        var_dump($item->category->title); die;
    }

}