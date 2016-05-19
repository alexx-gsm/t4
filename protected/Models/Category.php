<?php

namespace App\Models;


use T4\Orm\Model;

class Category extends Model
{
    static protected $schema = [
        'table' => 'categories',
        'column' => [
            'title' => ['type' =>'string'],
            ]
    ];

    static protected $extensions = ['tree'];
}