@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile  -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img mg-fluid w-50 p-2"
                                src="{{asset('storage/avatars/'.$user->avatar)}}" alt="Steve avatar">
                        </div>

                        {{-- User name --}}
                        <h3 class="profile-username text-center">
                            {{$user->name}}
                        </h3>

                        {{-- User email --}}
                        <p class="text-muted text-center">
                            {{$user->email}}
                        </p>

                        {{-- User stats --}}
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Joined: </b>
                                <p class="float-right">
                                    {{$user->created_at->diffForHumans()}}
                                </p>
                            </li>
                            <li class="list-group-item">
                                <b>Latest profile update</b>
                                <p class="float-right">
                                    {{$user->updated_at->diffForHumans()}}
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
                            @if ($user->is_admin == 0)
                            <a href="{{ route('make.admin', $user->id) }}" class="btn btn-primary btn-block">
                                <b>
                                    Make Admin
                                </b>
                            </a> 
                            @else
                            <a href="{{ route('destroy.admin', $user->id) }}" class="btn btn-primary btn-block">
                                <b>
                                    Demote Admin
                                </b>
                            </a> 
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
