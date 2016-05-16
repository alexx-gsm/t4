<?php

namespace App\Controllers;

use T4\Mvc\Controller;
use T4\Http\Uploader;

class Post
    extends Controller
{
    public function actionDefault()
    {
        $this->data->posts = \App\Models\Post::findAll();
    }

    public function actionPost($id)
    {
        $this->data->post = \App\Models\Post::findByPK($id);
    }
    
    public function actionNew()
    {

    }
    
    public function actionSave(\App\Models\Post $post)
    {
        $request = $this->app->request;

        if ($request->isUploaded('image')) {
            $uploader = new Uploader('image', ['jpg', 'jpeg', 'png', 'gif']);
            $uploader->setPath('/imgs');
            $image = $uploader();
        };

        if ( isset($post->__id) && ($post->__id > 0) ) {
            $post->setNew(false);                           // пост не "новый"
        }
        if ( $post->date == '' ) {                          // для нового поста добавляем текущую дату
            $post->date = date('y/m/d');
        }

        $post->save();                                      // команда модели Post сохранить новую статью в "БД"

        $this->redirect('/admin');                          // ушли на главную страницу админки с таблицей новостей
    }

    public function actionEdit($id)
    {
        $this->data->post = \App\Models\Post::findByPK($id);
    }
    
    public function actionDelete($id)
    {
        $post = \App\Models\Post::findByPK($id);
        
        if (!$post == null ) {
            $post->delete();
        }

        $this->redirect('/admin');                          // ушли на главную страницу новостей
    }
}