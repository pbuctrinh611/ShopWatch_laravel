<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    public function index() {
        return view('user.blog.index');
    }

    public function fetchBlogPage(Request $request) {
        $is_homepage = !empty($request->is_homepage) ? $request->is_homepage : '';
        $blogs = Blog::orderBy('id', 'desc');
        if($is_homepage == 1) {
            $blogs = $blogs->take(3);
        }
        $data = $blogs->get();
        return response()->json([
            'blogs' => $data
        ]);
    }
}
