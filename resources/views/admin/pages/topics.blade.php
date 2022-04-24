@extends('layouts.dashboard')

@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-laptop"></i>Topics</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                    <li><i class="fa fa-message"></i>Topics</li>
                </ol>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><i class="fa fa-flag-o red"></i><strong>Topics</strong></h2>
                        <div class="panel-actions">
                            <a href="/dashboard/home" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                            <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                            <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table bootstrap-datatable countries">
                            <thead>
                                <tr>
                                    <th>Show</th>
                                    <th>Topic Title</th>
                                    <th>Topic Description</th>
                                    <th>Forum Category</th>
                                    <th>Forum</th>
                                    <th>User</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($topic)> 0)
                                @foreach ($topic as $tp)
                                <tr>
                                    <td><a href="{{ route('topics', $tp->id) }}" class="text-success"><i
                                                class="fa-solid fa-eye"></i></a></td>
                                    <td>{{$tp->title}}</td>
                                    <td>{{$tp->desc}}</td>
                                    <td>
                                      <a href="{{route('category.overview', $tp->forum->category->id)}}" class="text-decoration-none">
                                        {{$tp->forum->category->title}}
                                      </a>
                                      </td>
                                    <td>
                                      <a href="{{route('forum.overview', $tp->forum->id)}}" class="text-decoration-none">
                                        {{$tp->forum->title}}
                                      </a>
                                    </td>
                                    <td><a href="{{ route('admin.show', $tp->user->id)}}">{{$tp->user->name}}</a></td>
                                    <td><a href="{{ route('topic.delete',$tp->id)}}" class="text-danger "><i
                                                class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                        {{ $topic->links() }}
                    </div>

                </div>

            </div>

        </div>
        <!--/col-->

        </div>



    </section>


</section>
<!--main content end-->
@endsection
