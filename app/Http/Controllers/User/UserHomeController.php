<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Blog;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index() {
        return view('user.home.index');
    }

}
