@extends('layouts.app')

@section('content')

<div class="container">
    <nav class="breadcrumb">
        <a href="/" class="breadcrumb-item"> Forum Categories</a>
        <a href="{{ route('category.overview', $forum->category->id)}}"
            class="breadcrumb-item">{{$forum->category->title}}</a>
        <span class="breadcrumb-item active">{{$forum->title}}</span>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <!-- Category one -->
                <div class="col-lg-12">
                    <!-- second section  -->
                    <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                        {{$forum->title}}
                    </h4>
                    <table class="table table-striped table-responsivelg table-bordered">
                        <thead class="thead-light">
                            
                            <tr>
                                <th scope="col">Topics</th>
                                <th scope="col" class="text-center">Statistics</th>
                                <th scope="col" class="text-center">Created</th>
                            </tr>
           

                        </thead>
                        <tbody>
                            {{-- Checks if there are any posts in the discussion form --}}
                            @if (count($forum->discussions) > 0)

                            {{-- if YES --}}
                            {{-- Shows all discussions that are in the forum --}}
                            @foreach ($forum->discussions as $topic)

                            <tr>
                                <td>
                                    <h3 class="h6">
                                        <a href="{{ route('topics', $topic->id) }}" class="text-decoration-none text-black">{{ $topic->desc }}</a>
                                    </h3>
                                </td>
                                <td>
                                    <div class="text-center">{{$topic->replies->count()}} topic replies</div>
                                </td>
                                <td>
                                    <div class="text-center"><p class="mb-0">{{$topic->user->name}}</p></div>
                                    <div class="text-center font-italic">{{ $topic->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            {{-- if NO --}}
                            {{-- Shows a message that explains that there are no discussions in the forum --}}
                            <h4>Be the first to start a discussion about {{$forum->title}}</h4>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('topic.new', $forum->id) }}" class="btn btn-lg text-white btn-info mb-2">New Topic</a>
</div>
@endsection
