<?php

namespace App\Models;

use T4\Core\Config;

class News extends Config
{
    public static function findAll()
    {
        return new Config(ROOT_PATH_PROTECTED . '/db.php');
    }

    public static function findOne($id)
    {
        $article = new Article();

        $news = News::findAll()[$id];       // порядковый номер в массиве = наш id

        foreach ($news as $k => $v) {
            $article[$k] = $v;
        }

        return $article;
    }

    public static function findLast()
    {
        $article = new Article();

        $news = News::findAll()->data;      // фильтруем массив
        $news = end($news);                 // выбираем последний элемент

        foreach ($news as $k => $v) {       // заполняем статью данными из базы
            $article[$k] = $v;
        }

        return $article;
    }
    
    public static function saveOne(Article $article)
    {
        $news = News::findAll();                // извлекли все статьи
        $id = count($news) + 1;                 // порядковый номер в массиве = наш id
        $article->id = $id;                     // для новой статьи id++
        $news->$id = $article;                  // добавляем новую статью в "БД"

        $news->save();                          // сохраняем данные в "БД"
    }
    
}