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

    /**
     * @param Category $category
     * @return \T4\Core\Collection|static[] - All products in Category $category
     */
    static public function findByCategory(Category $category)               // find products in selected category
    {
        return self::findAllByColumn('__category_id', $category->getPk());
    }

    /**
     * @param Category $category
     * @return array - All products in sub_categories of Category $category
     */
    static public function findAllByCategory(Category $category)            // find products in sub_categories
    {
        $sub_categories = $category->findAllChildren();

        $sub_products = [];
        foreach ($sub_categories as $cat) {
            $sub_products[$cat->title] = self::findByCategory($cat);
        }

        return $sub_products;
    }
}