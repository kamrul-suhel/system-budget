<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identifier'    => (int) $product->id,
            'stock'    => (int) $product->quantity,
            'title'    => (string) $product->name,
            'detail'    => (string) $product->description,
            'situation'    => (string) $product->status,
            'picture'    => url("images/{$product->image}"),
            'seller'    => (int) $product->seller_id,
            'creationdate'    => (string) $product->created_at,
            'lastchange'    => (string) $product->updated_at,
            'deleteddate'   => isset($product->deleted_at) ? (string) $product->deleted_al : null,
            'links' =>[
                [
                    'rel'   => 'self',
                    'href'  => route('products.show',$product->id)
                ],
                [
                    'rel'   => 'product.buyer',
                    'href'  => route('products.buyers.index',$product->id)
                ],
                [
                    'rel'   => 'product.category.index',
                    'href'  => route('products.categories.index',$product->id)
                ],
                [
                    'rel'   => 'product.transaction.index',
                    'href'  => route('products.transactions.index',$product->id)
                ]
            ]
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identifier'    => 'id',
            'stock'    => 'quantity',
            'title'    => 'name',
            'detail'    => 'description',
            'situation'    => 'status',
            'picture'    => 'image',
            'seller'    => 'seller_id',
            'creationdate'    => 'created_at',
            'lastchange'    => 'updated_at',
            'deleteddate'   => 'deleted_at'
        ];
        return isset($attributes[$index]) ? $attributes[$index]: null;
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identifier',
            'quantity' => 'stock',
            'name' => 'title',
            'description' => 'detail',
            'status' => 'situation',
            'image' => 'picture',
            'seller_id' => 'seller',
            'created_at' => 'creationdate',
            'updated_at' => 'lastchange',
            'deleted_at' => 'deleteddate'
        ];
        return isset($attributes[$index]) ? $attributes[$index]: null;
    }
}
