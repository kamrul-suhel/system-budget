<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

	const UNAVAILABLE_PRODUCT = 'unavailable';
	const ABAILABLE_PRODUCT = 'available';

    protected $fillable = [
    	'name',
    	'description',
    	'status',
    	'quantity',
    	'image',
    	'seller_id'
    ];

    protected $hidden = [
        'pivot',
        'deleted_at'
    ];

    public function isAbaliable(){
    	return $this->status == Product::ABAILABLE_PRODUCT;
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transitions(){
        return $this->hasMany(Transaction::class);
    }
}
