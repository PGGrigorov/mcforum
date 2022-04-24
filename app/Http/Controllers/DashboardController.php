<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home(){ return view('admin.pages.home'); }

    public function show($id) {
        $user = User::find($id);
        return view('admin.pages.user', \compact('user'));
    }

    public function adminMake($id) {
        
        DB::update('UPDATE `sys`.`users` SET is_admin = 1 WHERE id = ?', [$id]);

        return back();

    }

    public function adminDestroy($id) {

        DB::update('UPDATE `sys`.`users` SET is_admin = 0 WHERE id = ?', [$id]);

        return back();
        
    }
}
