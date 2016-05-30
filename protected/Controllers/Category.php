<?php

namespace App\Controllers;


use App\Models\Category as Cat;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class Category extends Controller
{
    public function actionDefault($id = null)
    {
        $this->data->parent_id = $id;
        $this->data->tree = Cat::findAllTree();
    }

    public function actionEdit($category_id = 0)
    {
        if ($category_id > 0) {                                     // EDIT category
            $this->data->category = Cat::findByPK($category_id);
        }

        if( isset($this->app->flash->errors) ) {
            $this->data->category = $this->app->flash->form;
            $this->data->errors = $this->app->flash->errors;
        }
    }

    public function actionSave($form = null)
    {
        $category = ( isset($form->pk) && ($form->pk > 0) ) ? Cat::findByPK($form->pk) : new Cat();
        $category->parent = Cat::findByPK($form->id);
        try {
            $category->fill($form);
            $category->save();
            $this->redirect('/category');
        } catch (MultiException $errors) {
            $this->app->flash->errors = $errors;
            $this->app->flash->form = $form;
            $this->redirect('/category/edit');
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