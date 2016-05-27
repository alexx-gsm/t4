<?php

namespace App\Controllers;


use App\Models\Category as Cat;
use T4\Core\Exception;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class Category extends Controller
{
    public function actionDefault()
    {
        $this->data->tree = Cat::findAllTree();
    }
    
    public function actionAdd($form = null)
    {
        if ( !$form == null ) {
            $category = new Cat();
            
            $parent = Cat::findByPK($form->parent_id);

            if( !empty($parent) ) {
                $category->parent = $parent;
            }

            try {
                $category->fill($form);
                $category->save();
                $this->redirect('/category');
            } catch (MultiException $err) {
                $this->data->form = $form;
                $this->data->errors = $err;
            };
            
        }
        
        $this->data->tree = Cat::findAllTree();
    }

    public function actionDel(int $category_id)
    {
        $category = Cat::findByPK($category_id);
        if ( !empty($category) ) {
            $category->delete();
        }
        $this->redirect('/category');
    }

    public function actionUp(int $category_id)
    {
        $category = Cat::findByPK($category_id);
        
        if( empty($category) )
            $this->redirect('/category');
        $sibling = $category->getPrevSibling();
        if( !empty($sibling) )
            $category->insertBefore($sibling);

        $this->redirect('/category');
    }

    public function actionDown(int $category_id)
    {
        $category = Cat::findByPK($category_id);

        if( empty($category) )
            $this->redirect('/category');
        $sibling = $category->getNextSibling();
        if( !empty($sibling) )
            $category->insertAfter($sibling);

        $this->redirect('/category');
    }
}