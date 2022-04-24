@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="row">

            @if (count($category) > 0)
            @foreach ($category as $cat)
            <div class="col-lg-12">
                <a href="{{ route('category.overview', $cat->id) }}" class="text-decoration-none">
                    <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                        {{$cat->title}}
                    </h4>
                </a>

                <table class="table table-striped table-responsive table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Forum name</th>
                            <th scope="col" class="text-center">Topics</th>
                        </tr>
                    </thead>

                    @if (count($cat->forums) > 0)
                    @foreach ($cat->forums as $forum)
                    <tbody>
                        <tr>
                            <td>
                                <h3 class="h5">
                                    
                                    <a href="{{ route('forum.overview', $forum->id) }}"
                                        class="text-uppercase text-black text-decoration-none">{{ $forum->title }}</a>
                                </h3>
                                <p class="mb-0">
                                    {!! $forum->desc !!}
                                </p>
                            </td>
                            <td>
                                <div class="text-center">{{ count($forum->discussions) }}</div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    @else
                    <h5 class="p-4">
                        <center>There are no forums about {{ $cat->title }} yet! 😕</center>
                    </h5>
                    @endif

                </table>
            </div>
            @endforeach
            @else
            <h5>There are no minecraft categories found</h5>
            @endif

        </div>
    </div>
    <div class="col-lg-4">
        <aside>
            <div class="card">
                <div class="card-body ">
                    <h4 class="card-title">MC Forum Statistics</h4>
                    <dl class="row">
                        <dt class="col-4 mb-0">Categories</dt>
                        <dd class="col-3 mb-0">{{$totalCategories}}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 mb-0">Forums:</dt>
                        <dd class="col-3 mb-0">{{$forumCount}}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 mb-0">Topics:</dt>
                        <dd class="col-3 mb-0">{{$topicCount}}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 mb-0">Members:</dt>
                        <dd class="col-3 mb-0">{{$totalUsers}}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    @if (!$newest)
                    {{route('login')}}
                    @else
                    <div>
                        <p class="mb-2 text-black font-weight-bold text-center">
                            <span>
                                <a href="{{route('user.show', $newest->id)}}" class="text-decoration-none text-black">
                                    {{$newest->name}}
                                </a>
                            </span>
                            is the newest member
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
