<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSerial extends Model
{
    //
    use SoftDeletes;

    public $fillable = [
        'product_serial',
        'is_use'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
