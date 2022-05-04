<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Blog;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index() {
        $product_new = Product::all();
        $product_sale = Product::all();
        $product_best = Product::all();
        $brands = Brand::all();
        $blogs = Blog::all();
        return view('user.home.index', compact('product_new', 'product_sale', 'product_best', 'brands', 'blogs'));
    }
}
