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

    public function fetchBlogPage() {
        $blogs = Blog::orderBy('id', 'desc');
        $data = $blogs->get();
        return response()->json([
            'blogs' => $data,
        ]);
    }
}
