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
        $products = Product::with('category', 'brand', 'colors')->orderBy('id', 'desc');
        if($is_homepage == 1) {
            $products = $products->take(4);
        }
        $searchProduct = !empty($request->searchProduct) ? $request->searchProduct : '';
        if(!empty($searchProduct)) {
            $products->where(function ($query) use ($searchProduct) {
                $query->where('product.name', 'LIKE', '%' . $searchProduct . '%');
            });
        }
        $filterProductByCategory = !empty($request->filterProductByCategory) ? $request->filterProductByCategory : '';
        if(!empty($filterProductByCategory)) {
            $products->where(function ($query) use ($filterProductByCategory) {
                $query->where('product.id_category', $filterProductByCategory);
            });
        }
        $filterProductByBrand = !empty($request->filterProductByBrand) ? $request->filterProductByBrand : '';
        if(!empty($filterProductByBrand)) {
            $products->where(function ($query) use ($filterProductByBrand) {
                $query->where('product.id_brand', $filterProductByBrand);
            });
        }
        $filterProductByColor = !empty($request->filterProductByColor) ? $request->filterProductByColor : '';
        if(!empty($filterProductByColor)) {
            $products->where(function ($query) use ($filterProductByColor) {
                $query->where('product.', $filterProductByColor);
            });
        }
        $data = $products->get();
        return response()->json([
            'products' => $data
        ]);
    }
}
