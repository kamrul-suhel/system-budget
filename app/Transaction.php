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

//    public $transformer = TransactionTransformer::class;
    protected $dates = ['deleted_at'];

    //Transaction product
    const TRANSICTION_STATUS_OK = 1;
    const TRANSACTION_STATUS_DUE = 2;

    const PAYMENT_PAIED = 1;
    const PAYMENT_DUE = 2;
    const PAYMENT_HALF_PAIED = 3;

    //
    protected $fillable = [
    	'quantity',
    	'customer_id',
    	'product_id',
        'payment_status',
        'payment_due',
        'paied',
        'discount_amount',
        'total',
        'invoice_number'
    ];

    protected $hidden =[
        'deleted_at'
    ];

     public function customer(){
     	return $this->belongsTo(Customer::class);
     }

     public function products(){
     	return $this->belongsToMany(Product::class)
            ->withPivot(['sale_quantity'])
            ->withTimestamps();
     }

     public static function getPaymentStatusType(){
        return [
            'paied' => self::PAYMENT_PAIED,
            'half_paied' => self::PAYMENT_HALF_PAIED,
            'due'   => self::PAYMENT_DUE
        ];
     }
    
}
