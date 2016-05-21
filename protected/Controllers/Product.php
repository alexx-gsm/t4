<?php

namespace App\Controllers;


use App\Models\Category;
use T4\Mvc\Controller;

class Product extends Controller
{
    public function actionDefault(int $category_id = 1)
    {
        $this->data->products = \App\Models\Product::findByCategory($category_id);  // products in selected category
        $this->data->categories = Category::findAllTree();                          // all categories for <SELECT>..</
        $this->data->selected_category = Category::findByPK($category_id);          // name of selected category
        
        $this->data->sub_products = \App\Models\Product::findAllChildren($category_id); // all products in sub_categories
//        var_dump($this->data->sub_products); die;
    }

}