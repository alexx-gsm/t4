<?php

namespace App\Controllers;


use App\Models\Category;
use T4\Mvc\Controller;

class Product extends Controller
{
    public function actionDefault(int $category_id = null)
    {
        $this->data->categories = Category::findAllTree();                          // all categories for <SELECT>..</

        if( !$category_id == null ) {
            $category = Category::findByPK($category_id);
            $this->data->selected_category = $category;                                 // name of selected category
            $this->data->products = \App\Models\Product::findByCategory($category);    // products in selected category
            $this->data->sub_products = \App\Models\Product::findAllByCategory($category); // all products in sub_categories
        }

    }

}