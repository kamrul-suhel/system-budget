<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //

    protected $fillable = [
        'title',
        'description',
        'amount',
        'payment_type',
        'expense_categories_id',
    ];

    public function category(){
        return $this->belongsTo('App\ExpenseCategory', 'expense_categories_id');
    }
}
