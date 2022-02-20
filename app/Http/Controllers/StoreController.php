<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function productDetail($id){
        return view('product-detail');
    }

    public function allProduct($filter){
        return view('all-product');
    }

    public function lookbook($page){
        return view('lookbook');
    }
}
