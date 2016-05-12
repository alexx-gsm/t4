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
];
