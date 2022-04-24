<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index() {
        $users = User::latest()->paginate(10);

        return view('admin.pages.users', \compact('users'));
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $user = User::find($id);
        $user->fill($input)->save();
        return back();
    }

    public function delete(Request $request, $id) {
        DB::table('users')->where('id', $id)->delete();
        return back();
    }
}
