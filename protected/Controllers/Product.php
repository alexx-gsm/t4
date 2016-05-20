<?php

namespace App\Controllers;


use App\Models\Category;
use T4\Mvc\Controller;

class Product extends Controller
{
    public function actionDefault()
    {
        $cat = Category::findByPK(9);

//        $item = \App\Models\Product::findByPk(1);
        var_dump($cat->products); die;
    }

}