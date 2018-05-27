<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

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
