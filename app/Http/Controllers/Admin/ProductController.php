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
                'name.required'           =>  'T??n s???n ph???m l?? b???t bu???c',
                'price.required'          =>  'Gi?? s???n ph???m l?? b???t bu???c',
                'image.required'          =>  'H??nh ???nh l?? b???t bu???c',
                'warranty.required'       =>  '????? ?????m b???o l?? b???t bu???c',
                'is_waterproof.required'  =>  'Ch???ng n?????c l?? b???t bu???c',
                'glasses.required'        =>  'Ch???t li???u k??nh l?? b???t bu???c',
                'strap.required'          =>  'Ch???t li???u d??y ??eo l?? b???t bu???c',
                'watch_case.required'     =>  'Ch???t li???u v??? l?? b???t bu???c',
                'description.required'    =>  'M?? t??? l?? b???t bu???c',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }else {
            $data = $request->all();
            if($request->hasFile('image')) {
                $path = $request->file('image')->store('product', 'public');
                $data['image'] = $path;
            }
            $product = Product::create($data);
            if($product) {
                return response()->json([
                    'status' => 200,
                    'message' => "Th??m th??nh c??ng"
                ]);
            }
        }
    }

    public function edit(Request $request) {
        $id = $request->id;
        $product = Product::where('id', $id)->with('brand', 'category')->first();
        if ($product) {
            return response()->json([
                'status' => 200,
                'product'   => $product,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message'   => 'Kh??ng t??m th???y s???n ph???m',
            ]);
        }
    }

    public function update(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $validator = Validator::make($request->all(), 
            [
                'name' => 'required',
                'price' => 'required|numeric|min:1000',
                'warranty' => 'required',
                'is_waterproof' => 'required',
                'glasses' => 'required',
                'strap' => 'required',
                'watch_case' => 'required',
                'image' => 'image',
                'description' =>  'required',
            ],
            [
                'name.required' => 'T??n s???n ph???m l?? b???t bu???c',
                'price.required' => 'Gi?? s???n ph???m l?? b???t bu???c',
                'price.numeric' => 'Gi?? s???n ph???m sai ?????nh d???ng',
                'price.min'      =>  'Gi?? s???n ph???m ph???i t??? :min ?????ng tr??? l??n',
                'warranty.required' => '????? ?????m b???o l?? b???t bu???c',
                'is_waterproof.required' => '????? ch???ng n?????c l?? b???t bu???c',
                'glasses.required' => 'Ch???t li???u k??nh l?? b???t bu???c',
                'strap.required' => 'Ch???t li???u d??y ??eo l?? b???t bu???c',
                'watch_case.required' => 'Ch???t li???u v??? l?? b???t bu???c',
                'image.image' => 'Lo???i file n??y kh??ng ph?? h???p',
                'description.required' => 'M?? t??? s???n ph???m l?? b???t bu???c',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } 

      
            if ($product) {
                $data = $request->all();
                if ($request->hasFile('image')) {
                    Storage::disk('public')->delete($product->image);
                    $data['image'] =  $request->file('image')->store('product', 'public');
                }
                $product->update($data);
                return response()->json([
                    'status' => 200,
                    'message' => 'C???p nh???t th??nh c??ng.'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'error' => 'Kh??ng t??m th???y s???n ph???m.'
                ]);
            }
    }

    public function delete(Request $request) {
        $id = $request->id;
        $product = Product::find($id);
        if($product) {
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => "X??a s???n ph???m th??nh c??ng"
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'error' => 'Kh??ng t??m th???y s???n ph???m'
            ]);
        }
    }

    public function blocked(Request $request) {
        $id = $request->id;
        $product = Product::find($id);
        if($product) {
            $product->update([
                'status' => 0
            ]);
            return response()->json([
                'status' => 200,
                'message' => "Kh??a s???n ph???m th??nh c??ng"
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'error' => 'Kh??ng t??m th???y s???n ph???m'
            ]);
        }
    }

    public function active(Request $request) {
        $id = $request->id;
        $product = Product::find($id);
        if($product) {
            $product->update([
                'status' => 1
            ]);
            return response()->json([
                'status' => 200,
                'message' => "K??ch ho???t s???n ph???m th??nh c??ng"
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'error' => 'Kh??ng t??m th???y s???n ph???m'
            ]);
        }
    }
}
