<?php

namespace App;

use App\Scopes\BuyerScope;
use App\Transformers\BuyerTransformer;
use App\User;
use App\Transaction;


class Buyer extends User
{
    public $transformer = BuyerTransformer::class;
    //
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope(new BuyerScope);
    }


    public function transitions(){
    	return $this->hasMany(Transaction::class);
    }
}
