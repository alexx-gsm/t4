<?php

namespace App\Controllers;

use App\Models\Article;
use T4\Mvc\Controller;
use T4\Http\Uploader;

class News extends Controller
{

    public function actionDefault()
    {
        $this->data->news = \App\Models\News::findAll();
    }
    
    public function actionOne($id)
    {
        $this->data->article = \App\Models\News::findOne($id);
    }

    public function actionLast()
    {
        $this->data->last = \App\Models\News::findLast();
    }

    public function actionNew()
    {
        
    }
    
    public function actionAdd(Article $article)
    {
        $request = $this->app->request;
        if ($request->existsFilesData() || $request->isUploaded('img') || $request->isUploadedArray('img')) {
            $uploader = new Uploader('img', ['jpg', 'jpeg', 'png', 'gif']);
            $uploader->setPath('/imgs');
            $img = $uploader();

            \App\Models\News::saveOne($article);    // команда модели News сохранить новую статью в "БД"
        }

        $this->redirect('/news');               // ушли на главную страницу новостей
    }

}