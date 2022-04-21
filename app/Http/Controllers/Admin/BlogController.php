<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateBlog;
use App\Http\Requests\Blog\UpdateBlog;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    //
    
    protected $limit;

    public function __construct()
    {
        $this->limit = Config::get('constants.limit_page');
    }

	public function index()
	{
		$blogs = Blog::paginate($this->limit);
		return view('admin.blog.list', compact('blogs'));
	}

	public function showCreateForm()
	{
		return view('admin.blog.add');
	}

	public function create(CreateBlog $request)
	{
		$data = $request->only('title', 'content');
		if ($request->hasFile('image')) {
			$data['image'] =  $request->file('image')->store('blog', 'public');
		}
		$new = Blog::create($data);
		return redirect(route('admin.blog.detail', ['id' => $new->id]))->with('alert-success', 'Tạo mới thành công!');
	}

	public function detail($id)
	{
		$blog = Blog::findOrFail($id);
		return view('admin.blog.detail', compact('blog'));
	}

	public function update(UpdateBlog $request, $id)
	{
		$data = $request->only('title', 'content');
		$blog = Blog::findOrFail($id);
		if ($request->hasFile('image')) {
			Storage::disk('public')->delete($blog->image);
			$data['image'] =  $request->file('image')->store('blog', 'public');
		}
		$blog->update($data);
		return back()->with('alert-success', 'Cập nhật thành công!');
	}
    
	public function search(Request $request)
	{
		$title = $request->get('title');
		$blogs = Blog::where('title', 'like', "%$title%")->paginate($this->limit);
		return view('admin.blog.list', compact('blogs', 'request'));
	}
}
