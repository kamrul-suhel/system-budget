<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;

class SellerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $transitions = $seller
            ->products()
            ->whereHas('transitions')
            ->with('transitions')
            ->get()
            ->pluck('transitions')
            ->collapse();

        return $this->showAll($transitions);

    }
}
