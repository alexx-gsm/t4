<?php

return [
    '/news/last'        => '//News/Last',
    '/news/new'         => '//News/New',
    '/news/article_<1>' => '//News/One(id=<1>)',
    '/news/add' => function ($request, $matches) {
        return new \T4\Mvc\Route([
            'controller' => 'News',
            'action' => 'Add',
            'params' => [
                'article' => [
                    'title' => htmlspecialchars( $_POST['title'] ?? '' ),
                    'intro' => htmlspecialchars( $_POST['intro'] ?? '' ),
                    'text'  => htmlspecialchars( $_POST['text'] ?? '' ),
                    'img'   => '/imgs/' . htmlspecialchars( $_FILES['img']['name'] ?? '' ),
                ]
            ],
        ]);
    },

    '/admin'            => '//Post/Default',
    '/admin/posts'      => '//Post/Default',
    '/admin/post/new'   => '//Post/New',
    '/admin/post/add'   => function ($request, $matches) {
        return new \T4\Mvc\Route([
            'controller' => 'Post',
            'action' => 'Save',
            'params' => [
                'post' => [
                    'title' => htmlspecialchars( $_POST['title'] ?? '' ),
                    'intro' => htmlspecialchars( $_POST['intro'] ?? '' ),
                    'text'  => htmlspecialchars( $_POST['text'] ?? '' ),
                    'image' => '/imgs/' . htmlspecialchars( $_FILES['image']['name'] ?? '' ),
                ]
            ],
        ]);
    },
    '/admin/post/edit/<1>'   => '//Post/Edit(id=<1>)',
    '/admin/post/save/<1>'   => function ($request, $matches) {
        return new \T4\Mvc\Route([
            'controller' => 'Post',
            'action' => 'Save',
            'params' => [
                'post' => [
                    '__id'  => htmlspecialchars( $_POST['id'] ),
                    'title' => htmlspecialchars( $_POST['title'] ?? '' ),
                    'intro' => htmlspecialchars( $_POST['intro'] ?? '' ),
                    'text'  => htmlspecialchars( $_POST['text'] ?? '' ),
                    'image' => $_FILES['image']['name'] ? htmlspecialchars('/imgs/' .  $_FILES['image']['name']) : htmlspecialchars( $_POST['imgDefault'] ),
                    'date'  => htmlspecialchars( $_POST['date'] ?? '' ),
                ]
            ],
        ]);
    },
    '/admin/post/del/<1>'   => '//Post/Delete(id=<1>)',
    '/admin/post/<1>'       => '//Post/Post(id=<1>)',

];
