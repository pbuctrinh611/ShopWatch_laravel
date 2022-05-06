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

    public function fetchProductPage(Request $request) {
        $is_homepage = !empty($request->is_homepage) ? $request->is_homepage : '';
        $products = Product::with('brand', 'category')->orderBy('id', 'desc');
        if($is_homepage == 1) {
            $products = $products->take(4);
        }
        $data = $products->get();
        return response()->json([
            'products' => $data
        ]);
    }
}
