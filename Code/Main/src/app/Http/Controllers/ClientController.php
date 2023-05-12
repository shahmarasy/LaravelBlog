<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();
        $categories = Category::all();
        $groupedCategories = $categories->groupBy('parent_id');

        return view('index', compact('posts', 'categories', 'groupedCategories'));
    }
}
