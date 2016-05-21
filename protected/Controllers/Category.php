<?php

namespace App\Controllers;


use App\Models\Category as Cat;
use T4\Mvc\Controller;

class Category extends Controller
{
    public function actionDefault()
    {
        $this->data->tree = Cat::findAllTree();
    }
    
    public function actionAdd()
    {
        $this->data->tree = Cat::findAllTree();
    }

    public function actionSave(int $parent_id, $title)
    {
        $category = new Cat();

        if (!$parent_id == null) {
            $parent = Cat::findByPK($parent_id);
            if( !empty($parent) ) {
                $category->parent = $parent;
            }
        }

        $category->title = $title;
        $category->save();

        $this->redirect('/category');
    }
    
    public function actionDel(int $category_id)
    {
        $category = Cat::findByPK($category_id);
        if ( !empty($category) ) {
            $category->delete();
        }
        $this->redirect('/category');
    }
}