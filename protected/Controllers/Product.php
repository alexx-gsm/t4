<?php

namespace App\Controllers;

use App\Models\Category;
use T4\Mvc\Controller;
use T4\Core\MultiException;

class Product extends Controller
{
    public function actionDefault($form = null)             // name of selected category
    {
        if( !$form->id == null ) {
            $this->data->category = Category::findByPK($form->id);
        }
    }

    public function actionInCategory($id)                   // products in selected category
    {
        if (!$id == null) {
            $this->data->category = Category::findByPK($id);
        }
    }

    public function actionInSubCategory($id)                // products in selected category
    {
        if (!$id == null) {
            $this->data->category = Category::findByPK($id);
            $this->data->sub_products = \App\Models\Product::findAllByCategory($this->data->category);
        }
    }

    public function actionEdit($category_id = null, $product_id = null)
    {
        $this->data->category_id = $category_id;

        if (!$product_id == null) {
            $this->data->product = \App\Models\Product::findByPK($product_id);
        }

        if( isset($this->app->flash->errors) ) {
            $this->data->product = $this->app->flash->form;
            $this->data->errors = $this->app->flash->errors;
        }
    }

    public function actionSave($form = null)
    {
        $product = ( isset($form->pk) && ($form->pk > 0) ) ? \App\Models\Product::findByPK($form->pk) : new \App\Models\Product();
        $product->category = Category::findByPK($form->id);
        try {
            $product->fill($form);
            $product->save();
            $this->redirect('/product?form[id]='.$form->id);
        } catch (MultiException $errors) {
            $this->app->flash->errors = $errors;
            $this->app->flash->form = $form;
            $this->redirect('/product/edit?category_id='.$product->category->getPk());
        }
    }

    public function actionDel($product_id)
    {
        $product = \App\Models\Product::findByPK($product_id);
        $category = $product->category;
        if ( !empty($product) ) {
            $product->delete();
        }
        $this->redirect('/product?form[id]='.$category->getPk());
    }
}