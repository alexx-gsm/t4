<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 14.05.2016
 * Time: 23:04
 */

namespace App\Models;


use T4\Orm\Model;

class Post extends Model
{
    static protected $schema = [
        'columns' => [
            'title' => ['type' => 'string'],
            'intro' => ['type' => 'string'],
            'text'  => ['type' => 'string'],
            'image' => ['type' => 'string'],
            'date'  => ['type' => 'date'],
        ],
    ];
}