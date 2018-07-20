<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable =[
        'name',
        'address',
        'description',
        'reference_number',
        'phone',
        'mobile',
        'fax',
        'email',
        'websiteurl',
        'city',
        'status'
    ];

    //relationship
    public function transactions(){
        return $this->hasMany(CompanyTransaction::class);
    }

    public function getStatusAttribute($value){
        return $value == 1 ? 'Active' : 'Inactive';
    }

    public function setStatusAttribute($value){
        $this->attributes['status'] = $value == 'Active'? 1 : 0;
    }
}
