<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index() {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $colors = Color::all();
        return view('user.product.index', compact('categories', 'brands', 'colors'));
    }

    public function fetchProductPage() {
        $products = Product::with('brand', 'category')->orderBy('id', 'desc');
        $data = $products->get();
        return response()->json([
            'products' => $data
        ]);
    }
}
