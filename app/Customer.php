<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    const PAYMEN_PAIED = 1;
    const PAYMENT_DUE = 2;
    const PAYMENT_HALF_PAIED = 3;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'mobile',
        'address',
        'active',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function transitions(){
        return $this->hasMany(Transaction::class);
    }
}
