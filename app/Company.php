<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable =[

    ];

    //relationship
    public function transactions(){
        return $this->hasMany(CompanyTransaction::class);
    }
}
