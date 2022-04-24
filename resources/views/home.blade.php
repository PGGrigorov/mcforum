@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img mg-fluid w-50 p-2"
                                src="{{asset('storage/avatars/'.auth()->user()->avatar)}}" alt="Steve avatar">
                        </div>

                        {{-- User name --}}
                        <h3 class="profile-username text-center">
                            {{auth()->user()->name}}
                        </h3>

                        {{-- User email --}}
                        <p class="text-muted text-center">
                            {{auth()->user()->email}}
                        </p>

                        {{-- User list ( joined, latest profile update, user rank )--}}
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Joined: </b>
                                <p class="float-right">
                                    {{auth()->user()->created_at->diffForHumans()}}
                                </p>
                            </li>
                            <li class="list-group-item">
                                <b>Latest profile update</b>
                                <p class="float-right">
                                    {{auth()->user()->updated_at->diffForHumans()}}
                                </p>
                            </li>
                            <li class="list-group-item">
                                <b>Rank</b>
                                <p class="float-right"> 
                                    <img src="{{asset('storage/images/ranks/'.$rank_badge->badge)}}" style="width:40px" alt="{{$rank_badge->name}} badge">
                                </p>
                            </li>
                        </ul>
                       
                        @if (auth()->user()->is_admin != 0)
                        <a href="{{ route('dashboard.home') }}" class="btn btn-primary btn-block"><b>Admin
                                Dashboard</b></a>   
                        @endif
                    </div>
                </div>
            </div>

            {{-- Settings panel --}}
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item text-black">
                                <p class="nav-link" class="text-black" data-toggle="tab">{{auth()->user()->name}}'s
                                    settings panel</p>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">

                                <form class="form-horizontal" action="{{ route('update.user', auth()->user()->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group p-2 row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" id="inputName"
                                                value="{{auth()->user()->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group p-2 row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password" id="inputPassword"
                                                placeholder="********" value="">
                                        </div>
                                    </div>
                                    <div class="form-group p-2 row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password_confirm" id="inputPassword"
                                                placeholder="********" value="">
                                        </div>
                                    </div>
                                    <div class="form-group p-2 row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Profile Pic</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control-file" name="profile_pic" id="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
               
            </div>
            
        </div>
        
    </div>
</section>
@endsection
