@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('index') }}" class="breadcrumb-item">Forum Categories</a>
        <span class="breadcrumb-item active">{{$category->title}}</span>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <!-- Category one -->
                <div class="col-lg-12">
                    <!-- second section  -->
                    <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                        {{$category->title}}
                    </h4>
                    <table class="table table-striped table-responsive table-bordered mb-xl-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Forum name</th>
                                <th scope="col" class="text-center">Topics</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($category->forums) > 0)
                            @foreach ($category->forums as $forum)
                            <tr>
                                <td>
                                    <h3 class="h5">
                                        <a href="{{ route('forum.overview', $forum->id )}}" class="text-uppercase text-decoration-none text-black">
                                            {{$forum->title}}
                                        </a>
                                    </h3>
                                    <p class="mb-0">
                                        {!! $forum->desc !!}
                                    </p>
                                </td>
                                <td>
                                    <div class="text-center">{{count($forum->discussions)}}</div>
                                </td>
                               
                            </tr>
                            @endforeach
                            @else

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
