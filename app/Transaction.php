<?php

namespace App;

use App\Buyer;
use App\Product;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public $transformer = TransactionTransformer::class;
    protected $dates = ['deleted_at'];

    //Transaction product
    const TRANSICTION_STATUS_OK = 1;
    const TRANSACTION_STATUS_DUE = 2;

    //
    protected $fillable = [
    	'quantity',
    	'customer_id',
    	'product_id',
        'payment_status'
    ];

    protected $hidden =[
        'deleted_at'
    ];

     public function customer(){
     	return $this->belongsTo(Customer::class);
     }

     public function product(){
     	return $this->belongsTo(Product::class);
     }
    
}
