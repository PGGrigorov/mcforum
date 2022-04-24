<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Support\Facades\Session;
use Laravel\Ui\Presets\React;
use Auth;
use Image;
use DB;
use App\Models\User;
use App\Models\ReplyLike;
use App\Models\ReplyDislike;
use App\Models\Topic;
use App\Models\Category;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic = Discussion::latest()->paginate(20);
        $forum = Forum::all();
        $category = Category::all();
        $discussion = Discussion::all();
        
        

        return view('admin.pages.topics', \compact('topic'));
    }

    public function topicDestroy($id) {
        $topic = Discussion::find($id);
        $topic->delete();

        $user = User::find($topic->user_id);
        $user->decrement('rank', 20);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $forum = Forum::latest()->get();
        $frm = Forum::find($id);
        return view('client.topic-new', \compact('forum', 'frm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $notify = 0;

       if ($request->notify && $request->notify == 'on') {
            $notify = 1;
       }


        $topic = new Discussion;
        $topic->title = $request->title;
        $topic->desc = $request->desc;
        $topic->forum_id = $request->forum_id;
        $topic->title = $request->title;
        $topic->user_id = auth()->id();
        $topic->notify = $notify;
        $topic->save();

        $user = auth()->user();
        $user->increment('rank', 10);

        Session::flash('message', 'The topic was created successuffly');
        Session::flash('alert-class', 'alert-success');
        return back();
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Discussion::find($id);

        if ($topic) $topic->increment('views', 1);

        return view('client.topic', \compact('topic'));
    }


    public function reply(Request $request, $id) {

        $reply = new DiscussionReply;
        $reply->desc = $request->desc;
        $reply->user_id = auth()->id();
        $reply->discussion_id = $id;
        $reply->save();

        
        $user = User::find($reply->user_id);
        $user->increment('rank', 20);

        return back()->with('error', 'Something happened :(');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = DiscussionReply::find($id);
        $reply->delete();

        $user = User::find($reply->user_id);
        $user->decrement('rank', 20);
        return back();
    }


    public function like($id) {
      
        $reply = DiscussionReply::find($id);
        $user_id = $reply->user_id;

        /* 
        Checks if the user has already liked the topic.
        If 'yes' then he will be redirected back without making changes to the like counter
        */
        $liked = ReplyLike::where('user_id', '=', auth()->id())->where('reply_id', '=', $id)->get();
        if (count($liked) > 0) return back();
        
        /*
        Adds the user and the topic that the user liked to the database.
        */
        $reply_like = new ReplyLike;
        $reply_like->user_id = auth()->id();
        $reply_like->reply_id = $id;
        $reply_like->save();
        
        // Awards the owner of the liked topic with a like and points for the rank
        $owner = User::find($user_id);
        $reply->increment('likes', 1);
        $owner->increment('rank', 20);
       
        return back();
    }

    public function dislike($id) {
        $reply = DiscussionReply::find($id);
        $user_id = $reply->id;

        $disliked = ReplyDislike::where('user_id', '=', auth()->id())->where('reply_id', '=', $id)->get();
        if (count($disliked) > 0) return back();
        

        $reply_disliked = new ReplyDislike;
        $reply_disliked->user_id = auth()->id();
        $reply_disliked->reply_id = $id;
        $reply_disliked->save();

        $owner = User::find($user_id);
        $reply->decrement('likes', 1);
        $owner->decrement('rank', 20);

        return back();
    }

}
