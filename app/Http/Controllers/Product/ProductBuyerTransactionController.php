<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\ApiController;
use App\Product;
use App\Seller;
use App\Transaction;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, Customer $customer)
    {
        $rules = [
          'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);


        if(!$product->isAbaliable()){
            return $this->errorResponse('The is not avaliable', 409);
        }

        if($product->quantity < $request->quantity ){
            return $this->errorResponse('The product do not have enough units for this transaction', 409);
        }

        $transaction = DB::transaction(function() use ($request, $product, $customer){

            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity'      => $request->quantity,
                'customer_id'      => $customer->id,
                'product_id'    => $product->id,
                'payment_status'=> $request->payment_status,
                'payment_due'   => $request->payment_due,
                'paied'         => $request->paied
            ]);

            return $transaction;
            // return $this->showOne($transaction, 201);
        });
        $product = $transaction
            ->with('product.seller')
            ->with('customer')
            ->first();
        return $this->showOne($product);
    }


}
