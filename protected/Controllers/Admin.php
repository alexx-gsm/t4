<?php

namespace App\Controllers;


use App\Models\Category;
use T4\Mvc\Controller;

class Admin extends Controller
{
    public function actionDefault()
    {
        $this->data->tree = Category::findAllTree();
    }
    
    public function actionAdd()
    {
        
    }
}