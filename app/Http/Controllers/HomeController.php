<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\User;
use App\Models\UserRank;
use App\Models\Rank;
use App\Models\Category;
use App\Models\Forum;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index () {
        $forumCount = count(Forum::all());
        $topicCount = count(Discussion::all());
        $totalUsers = count(User::all());
        $totalCategories = count(Category::all());
        $newest = User::latest()->first();
        $category = Category::latest()->get();
        return view('welcome', \compact('category', "forumCount", 'topicCount', 'newest', 'totalUsers', 'totalCategories'));
    }

    public function home(Request $request, $id) {
        $latest_user_post = Discussion::where('user_id', $id)->latest()->first();
        $latest = Discussion::latest()->first();
        $user = User::find($id);
        $rank = UserRank::find($id);
        
        // Check if exists
        if ($rank == null) {
            $newRank = new UserRank;
            $newRank->user_id = $user->id;
            $newRank->rank_id = 1;

            $newRank->save();
        }
        
           
        // Sets the user's rank
        if ($user->rank <= 10) {
            $user->rank = 10;
            $user->save();
        }
        
            // dd($rank->rank_id);
        if ($user->rank >=10 && $user->rank <= 100) 
            $rank->rank_id = 1;
            
        else if ($user->rank >= 101 && $user->rank <= 200)
            $rank->rank_id = 2;
            
        else if ($user->rank >= 202 && $user->rank <=500)
            $rank->rank_id = 3;
            
        else if ($user->rank >= 501)
            $rank->rank_id = 4;  
            
            
        $rank_badge = Rank::find($rank->rank_id);
           
        return view('home', compact('latest_user_post', 'latest', 'rank_badge'));
    }


    public function userShow($id) {
        $user = User::find($id);
        $rank = UserRank::find($id);

        
        
        // Check if exists
        if ($rank == null) {
            $newRank = new UserRank;
            $newRank->user_id = $user->id;
            $newRank->rank_id = 1;

            $newRank->save();
        }
        
           
        // Sets the user's rank to a minimum
        if ($user->rank <= 10) {
            $user->rank = 10;
            $user->save();
        }
        
        // Checks if the user has the points for the next or previous rank
        if ($user->rank >=10 && $user->rank <= 100) 
            $rank->rank_id = 1;
            
        else if ($user->rank >= 101 && $user->rank <= 200)
            $rank->rank_id = 2;
            
        else if ($user->rank >= 202 && $user->rank <=500)
            $rank->rank_id = 3;
            
        else if ($user->rank >= 501)
            $rank->rank_id = 4;  
            

        $rank_badge = Rank::find($rank->rank_id);
           
        return view('client.client_user', compact('user', 'rank_badge'));
    }

    public function update(Request $request, $id) {
        $user = User::find($id);

        // Changes the user image IF there is a new image
        if ($request->profile_pic) {
            $name = $request->profile_pic->getClientOriginalName();
            $request->profile_pic->move('storage/avatars/', time().'_'.$user->name.'_'.$name);
            $user->avatar = time().'_'.$user->name.'_'.$name;
        }
        
        // Changes the user's name IF there is a new name typed
        if ($request->name) $user->name = $request->name;
        
        // Changes the user's password IF there is a new one typed

        // Checks if there is a new password typed
        if ($request->password)
            // Checks if there is a confirm password typed
            if (!$request->password_confirm) return back();
            else 
                // Checks if the password and the confirmation are matching
                if ($request->password == $request->password_confirm) 
                    // Changes the password with the new password ( Hashed )
                    $user->password = Hash::make($request->password); 

       
        // Saves the new data IF there is any
        $user->save();
        return back();
    }

}
