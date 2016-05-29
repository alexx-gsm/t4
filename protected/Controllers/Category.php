<?php

namespace App\Controllers;


use App\Models\Category as Cat;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class Category extends Controller
{
    public function actionDefault($parent_id = null)
    {
        $this->data->parent_id = $parent_id;
        $this->data->tree = Cat::findAllTree();
    }

    public function actionEdit($category_id = 0)
    {
        if ($category_id > 0) {                                     // EDIT category
            $this->data->category = Cat::findByPK($category_id);
        }
        
        if( isset($this->app->request->post->save) ) {              // trying to SAVE category
            $form = $this->app->request->post->form;
            $category = ( $form->id == null ) ? new Cat() : Cat::findByPK($form->id);
            $category->parent = Cat::findByPK($form->__prt);
            try {
                $category->fill($form);
                $category->save();
                $this->redirect('/category');
            } catch (MultiException $err) {
                $this->data->category = $form;
                $this->data->errors = $err;
            }
        }
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