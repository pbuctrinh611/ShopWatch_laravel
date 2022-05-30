<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.index', compact('brands', 'categories'));
    }

    public function fetchProduct(Request $request) {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::with('brand', 'category')->orderBy('id', 'desc');
        $search_product = !empty($request->search_product) ? $request->search_product : '';
        if(!empty($search_product)) {
            $products->where(function ($query) use ($search_product) {
                $query->where('product.name', 'LIKE', '%' . $search_product . '%');
            });
        }
        $filter_category = !empty($request->filter_category) ? $request->filter_category : '';
        if(!empty($filter_category)) {
            $products->where(function ($query) use ($filter_category) {
                $query->where('product.id_category', $filter_category);
            });
        }
        $filter_brand = !empty($request->filter_brand) ? $request->filter_brand : '';
        if(!empty($filter_brand)) {
            $products->where(function ($query) use ($filter_brand) {
                $query->where('product.id_brand', $filter_brand);
            });
        }
        $data = $products->get();
        return response()->json([
            'products' => $data,
            'brands' => $brands,
            'categories'=> $categories
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name'          =>  'required',
                'price'         =>  'required',
                'image'         =>  'required',
                'warranty'      =>  'required',
                'is_waterproof' =>  'required',
                'glasses'       =>  'required',
                'strap'         =>  'required',
                'watch_case'    =>  'required',
                'description'   =>  'required',
            ],
            [
                'name.required'           =>  'Tên sản phẩm là bắt buộc',
                'price.required'          =>  'Giá sản phẩm là bắt buộc',
                'image.required'          =>  'Hình ảnh là bắt buộc',
                'warranty.required'       =>  'Độ đảm bảo là bắt buộc',
                'is_waterproof.required'  =>  'Chống nước là bắt buộc',
                'glasses.required'        =>  'Chất liệu kính là bắt buộc',
                'strap.required'          =>  'Chất liệu dây đeo là bắt buộc',
                'watch_case.required'     =>  'Chất liệu vỏ là bắt buộc',
                'description.required'    =>  'Mô tả là bắt buộc',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }else {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/product', $fileName);
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'image' => $request->fileName,
                'warranty' => $request->warranty,
                'is_waterproof' => $request->is_waterproof,
                'glasses' => $request->glasses,
                'strap' => $request->strap,
                'watch_case' => $request->watch_case,
                'description' => $request->description,
                'id_brand' => $request->id_brand,
                'id_category' => $request->id_category,
                'status'      => $request->status,
            ];
            $product = Product::create($data);
            if($product) {
                return response()->json([
                    'status' => 200,
                    'message' => "Thêm thành công"
                ]);
            }
        }
    }
}
