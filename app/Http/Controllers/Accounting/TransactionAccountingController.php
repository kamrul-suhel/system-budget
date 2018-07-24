<?php

namespace App\Http\Controllers\Accounting;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionAccountingController extends Controller
{
    //

    public function index(Request $request){
        $transactions = Transaction::with('products')
            ->where('created_at', '>', Carbon::now()->startOfDay())
            ->where('created_at', '<', Carbon::now()->endOfDay())->get();

        $total = $transactions->sum('total');
        dd($transactions);
    }
}
