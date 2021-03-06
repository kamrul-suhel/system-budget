<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductBuyerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $buyer = $product->transitions()
                ->whereHas('buyer')
                ->with('buyer')
                ->get()
                ->pluck('buyer')
                ->unique()
                ->values();
        return $this->showAll($buyer);
    }
}
