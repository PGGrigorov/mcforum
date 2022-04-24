<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Discussion;
use App\Models\User;

class FrontEndController extends Controller
{
    public function index () {
        
        $forumCount = count(Forum::all());
        $topicCount = count(Discussion::all());
        $totalUsers = count(User::all());
        $totalCategories = count(Category::all());
        $newest = User::latest()->first();
        $category = Category::latest()->get();
        return view('welcome', \compact('category', "forumCount", 'topicCount', 'newest', 'totalUsers', 'totalCategories'));
    }

    public function categoryOverview($id) {
        $category = Category::find($id);
        return view('client.category-overview', \compact('category'));
    }

    public function forumOverview($id) {
        $forum = Forum::find($id);
        return view('client.forum-overview', \compact('forum'));
    }

        
}
