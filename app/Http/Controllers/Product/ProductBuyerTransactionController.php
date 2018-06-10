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
    public function store(Request $request, Customer $customer)
    {

        $transaction = DB::transaction(function() use ($request, $customer){
            $attach_product =[];
            $unique_id = $this->getUniqueId();

            $products = json_decode($request->products);




            foreach($products as $product){
                $cur_product= Product::find($product->product->id);
                $selected_quantity = $product->selected_quantity;
                $cur_product->quantity -= $selected_quantity;

                $attach_product[$product->product->id] = ['sale_quantity' => $product->selected_quantity];

                $cur_product->save();
            }

            $transaction = Transaction::create([
                'customer_id'      => $customer->id,
                'invoice_number'         => $unique_id,
                'discount_amount'          => $request->discount,
                'total'          => $request->total,
                'payment_status'=> $request->payment_status,
                'payment_due'   => $request->payment_due,
                'paied'         => $request->paied
            ]);

            $transaction->products()->sync($attach_product);
            return $transaction;
        });

        $product = $transaction
            ->with('products.seller')
            ->with('customer')
            ->first();

        return $this->showOne($product);
    }


}
