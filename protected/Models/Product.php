<?php

namespace App\Models;
use T4\Orm\Model;

/**
 * Class Product
 * @package App\Models
 * 
 * @property string $name
 */
class Product extends Model
{
    static protected $schema = [
        'columns'  => [
            'name' => ['type' => 'string'],
        ],
        'relations' => [
            'category'  => [
                'type' => self::BELONGS_TO,
                'model' => Category::class
            ],
        ],
    ];
}