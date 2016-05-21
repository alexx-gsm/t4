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

    static public function findAllChildren($id)
    {
        $parent_category = Category::findByPK($id);
        if( empty($parent_category) ) {
            return [];
        }
        $sub_categories = $parent_category->findAllChildren();
        $sub_products = [];

        foreach ($sub_categories as $cat) {
            $products = Product::findByCategory($cat->pk);
            if( !empty($products) ) {
                $sub_products[$cat->title] = $products;
            }
        }
        
        return $sub_products;
    }
}