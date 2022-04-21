<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrand;
use App\Http\Requests\Brand\UpdateBrand;
use App\Models\Brand;
use Illuminate\Support\Facades\Config;

class BrandController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = Config::get('constants.limit_page');
    }

    public function index()
    {
        $brands = Brand::paginate($this->limit);
        return view('admin.brand.list', compact('brands'));
    }

    public function detail($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.detail', compact('brand'));
    }

    public function showCreateForm()
    {
        return view('admin.brand.add');
    }

    public function create(CreateBrand $request)
    {
        $data = $request->only('name');
        $brand = Brand::create($data);
        return redirect(route('admin.brand.detail', ['id' => $brand->id]))->with('alert-success', 'Tạo mới thành công!');
    }

    public function update(UpdateBrand $request, $id)
    {
        $data = $request->only('name', 'status');
        Brand::findOrFail($id)->update($data);
        return back()->with('alert-success', 'Cập nhật thành công!');
    }
}
