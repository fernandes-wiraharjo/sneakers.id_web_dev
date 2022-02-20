<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function index() {
        $data['ok'] = 'OK';
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('welcome', $data);
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
