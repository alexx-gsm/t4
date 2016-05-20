<?php

namespace App\Models;
use T4\Dbal\QueryBuilder;
use T4\Orm\Model;

/**
 * Class Product
 * @package App\Models
 * 
 * @property string $name
 * @property \App\Models\Category $category
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

    static public function findByCategory($id)
    {
        $query = new QueryBuilder();
        $query
            ->select()
            ->from('products')
            ->where('__category_id=:category_id')
            ->params([':category_id' => $id]);

        return Product::findAllByQuery($query);

    }
}