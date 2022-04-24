@extends('layouts.dashboard')

@section('content')
<section id="main-content">
    <section class="wrapper">

        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-laptop"></i>{{ $user->name }}'s account</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                    <li><i class="fa fa-users"></i>{{$user->name}}</li>
                </ol>
            </div>
        </div>

        @if ($user )
        <div class="user_admins">
            <section class="content">
                <div class="container">
                    <section class="row">
                        <div class="col-md-3">
                            <!-- Profile  -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img mg-fluid w-50 p-2"
                                            src="{{asset('storage/avatars/'.$user->avatar)}}" alt="Steve avatar">
                                    </div>

                                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                                    <p class="text-muted text-center">{{$user->email}}</p>

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
                                            <p class="float-right">Badge name</p>
                                        </li>
                                    </ul>

                                    @if ($user->is_admin != 0)
                                    <a href="{{ route('dashboard.home') }}" class="btn btn-primary btn-block">
                                        <b>Admin Dashboard</b>
                                    </a>
                                    <a href="{{ route('destroy.admin', $user->id) }}" class="btn btn-primary btn-block">
                                        <b>Demote admin</b>
                                    </a>
                                    @else
                                    <p class="text-center">You can make {{$user->name}} an admin</p>
                                    <a href="{{ route('make.admin', $user->id) }}"
                                        class="btn btn-primary btn-block"><b>Make Admin</b></a>
                                    @endif
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </section>
            </section>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->

        </div>
    </section>
</section>
@endif
@endsection
