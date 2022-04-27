<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProduct;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $limit;

    public function __construct() {
        $this->limit = Config::get('constants.limit_page');
    }
    
    public function index()
    {
        $products = Product::paginate($this->limit);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.list', compact('products', 'categories', 'brands'));
    }

    public function showCreateForm()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.product.add', compact('categories', 'brands', 'colors'));
    }

    public function create(CreateProduct $request)
    {
        $data = $request->only([
            'name', 'price', 'qty', 'id_category', 'id_brand', 'warranty', 
            'is_waterproof', 'glasses', 'watch_case', 'strap', 'description'
        ]);
        $colors = $request->get('color');
        $id = $this->getNewId();

        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $data['image'] =  $request->file('image')->store("product/$id/", 'public');
            }
            if ($request->hasfile('image_detail')) {
                $path_images = [];
                foreach ($request->file('image_detail') as $file) {
                    $path_images[] =  $file->store("product/$id/", 'public');
                }
                $data['image_detail'] = json_encode($path_images, JSON_UNESCAPED_UNICODE);
            }
            $new_product = Product::create($data);
            foreach ($colors as $item) {
                if (intval($item['qty']) < 0) {
                    throw new Exception();
                }
                $item['id_product'] = $new_product->id;
                ProductColor::create($item);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('alert-fail', 'Thêm mới thất bại!');
        }
        DB::commit();
        return redirect(route('admin.product.detail', ['id' => $new_product->id]))->with('alert-success', 'Thêm mới thành công!');
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $product['image_detail'] = json_decode($product->image_detail) ?? [];
        $colors = Color::all();
        return view('admin.product.detail', compact('product', 'categories', 'brands', 'colors'));
    }

    public function update(UpdateProduct $request, $id)
    {
        $data = $request->only([
            'name', 'price', 'qty', 'id_category', 'id_brand', 'warranty', 
            'is_waterproof', 'glasses', 'watch_case', 'strap', 'status', 'description'
        ]);
        $colors = $request->get('color');
        $product = Product::findOrFail($id);
        $product->image_detail = json_decode($product->image_detail);
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($product->image);
                $data['image'] =  $request->file('image')->store("product/$id/", 'public');
            }
            if ($request->hasfile('image_detail')) {
                Storage::disk('public')->delete($product->image_detail);
                $path_images = [];
                foreach ($request->file('image_detail') as $file) {
                    $path_images[] =  $file->store("product/$id/", 'public');
                }
                $data['image_detail'] = json_encode($path_images, JSON_UNESCAPED_UNICODE);
            }
            $product->update($data);
            
            ProductColor::where('id_product', $product->id)->delete();

            foreach ($colors as $item) {
                if (intval($item['qty']) < 0) {
                    throw new Exception();
                }
                $item['id_product'] = $product->id;
                ProductColor::create($item);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('alert-fail', 'Tạo mới thất bại!');
        }
        DB::commit();
        return back()->with('alert-success', 'Cập nhật thành công!');
    }

    public function search(Request $request)
    {
        $categories =Category::all();
        $brands = Brand::all();
        $columns = $request->only(['id', 'name', 'id_category', 'id_brand', 'status']);
        $query = Product::query();
        $strict = ['id', 'id_brand', 'id_category', 'status'];
        foreach ($columns as $column => $value) {
            if (is_null($value)) {
                continue;
            }
            if (in_array($column, $strict)) {
                $query = $query->where($column, $value);
            } else {
                $query = $query->where($column, 'like', '%' . $value . '%');
            }
        }
        $products = $query->orderBy('id', 'desc')->paginate($this->limit)->appends($columns);
        return view('admin.product.list', compact('products', 'categories', 'brands', 'request'));
    }

    public function getNewId()
    {
        $databaseName = Config::get('database.connections');
        $database_name = $databaseName['mysql']['database'];
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$database_name' AND TABLE_NAME = 'product'";
        $result = DB::select($sql);
        $id = $result[0]->AUTO_INCREMENT;
        return is_null($id) ? 1 : $id;
    }
}
