<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rank;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rank = Rank::latest()->paginate(5);

        return view('admin.pages.ranks', \compact('rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.new_rank');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'required'
        ]);

        $image = $request->image;
        $name = $image->getClientOriginalName();
        $new_name = time().$name;
        $dir = "storage/images/ranks";
        $image->move($dir, $new_name);
    
        $rank = new Rank;
        $rank->name = $request->title;
        $rank->user_id = auth()->id();
        $rank->badge = $new_name;
        $rank->save();

        Session::flash('message', 'Category Created Successfully');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rank = Rank::find($id);
        return view('admin.pages.edit_rank', \compact('rank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image ='';
        $name ='';
        $new_name ='';
        $dir ='';
        if ($request->badge) {
            $image = $request->badge;
            $name = $image->getClientOriginalName();
            $new_name = time().$name;
            $dir = "storage/images/ranks";
            $image->move($dir, $new_name);
        }
            $rank = Rank::find($id);
          
            if ($request->title) $rank->name = $request->title;
            
            if ($request->badge) $rank->badge = $new_name;
            $rank->save();

            Session::flash('message', 'Category Updated Successfully');
            Session::flash('alert-class', 'alert-success');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rank = Rank::find($id);
        $rank->delete();
        Session::flash('message', 'Category Deleted Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();
    }
}
