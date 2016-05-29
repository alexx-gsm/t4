<?php

namespace App\Controllers;

use App\Models\Category;
use T4\Mvc\Controller;
use T4\Core\MultiException;

class Product extends Controller
{
    public function actionDefault($form = null)             // name of selected category
    {
        if( !$form == null ) {
            $this->data->category = Category::findByPK($form->__prt);
        }
    }

    public function actionInCategory($id)                   // products in selected category
    {
        if (!$id == null) {
            $this->data->category = Category::findByPK($id);
            $this->data->products = \App\Models\Product::findByCategory($this->data->category);
        }
    }

    public function actionInSubCategory($id)                // products in selected category
    {
        if (!$id == null) {
            $this->data->category = Category::findByPK($id);
            $this->data->sub_products = \App\Models\Product::findAllByCategory($this->data->category);
        }
    }

    public function actionEdit($category_id = null, $product_id = 0)
    {
        $this->data->category = Category::findByPK($category_id);

        if ($product_id > 0) {
            $this->data->product = \App\Models\Product::findByPK($product_id);
        }

        if( isset($this->app->request->post->save) ) {              // trying to SAVE product
            $form = $this->app->request->post->form;
            $product = ( $form->pk == null ) ? new \App\Models\Product() : \App\Models\Product::findByPK($form->pk);
            $this->data->category = Category::findByPK($form->__prt);
            $product->category = $this->data->category;
            try {
                $product->fill($form);
                $product->save();
                $this->redirect('/product?form[__prt]='.$form->__prt);
            } catch (MultiException $err) {
                $this->data->product = $form;
                $this->data->errors = $err;
            }
        }
    }

    public function actionDel($product_id)
    {
        $product = \App\Models\Product::findByPK($product_id);
        $category = $product->category;
        if ( !empty($product) ) {
            $product->delete();
        }
        $this->redirect('/product?form[__prt]='.$category->getPk());
    }

}