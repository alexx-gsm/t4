<?php

namespace App\Controllers;


use App\Models\Category;
use T4\Mvc\Controller;

class Product extends Controller
{
    public function actionDefault(int $category_id = 9)
    {
        $this->data->products = \App\Models\Product::findByCategory($category_id);
        $this->data->categories = Category::findAllTree();
        $this->data->current_category = Category::findByPK($category_id);
    }

}