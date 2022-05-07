<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategory;
use App\Http\Requests\Category\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
    //
    protected $limit;

    
    public function __construct()
    {
        $this->limit = Config::get('constants.limit_page');
    }
    public function index()
    {
        $categories = Category::paginate($this->limit);
        return view('admin.category.list', compact('categories'));
    }

    public function detail($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.detail', compact('category'));
    }

    public function showCreateForm()
    {
        return view('admin.category.add');
    }

    public function create(CreateCategory $request)
    {
        
        $data = $request->only('name');
        $category = Category::create($data);
        return redirect(route('admin.category.detail', ['id' => $category->id]))->with('alert-success', 'Tạo mới thành công!');
    }

    public function update(UpdateCategory $request, $id)
    {
        $data = $request->only('name', 'status');
        Category::findOrFail($id)->update($data);
        return back()->with('alert-success', 'Cập nhật thành công!');
    }
}
