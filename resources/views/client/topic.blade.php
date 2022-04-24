@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('index') }}" class="breadcrumb-item text-decoration-none"> Forum Categories</a>
        <a href="{{ route('category.overview', $topic->forum->category->id)}}"
            class="breadcrumb-item text-decoration-none">{{ $topic->forum->category->title }}</a>
        <a href="{{ route('forum.overview', $topic->forum->id)}}" class="breadcrumb-item text-decoration-none">{{ $topic->forum->title }}</a>
        <span class="breadcrumb-item active text-decoration-none"> {{$topic->title}}</span>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <!-- Category one -->
                <div class="col-lg-12">
                    <!-- second section  -->
                    <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                        {{$topic->title}}
                    </h4>
                    <table class="table table-striped table-responsivelg table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col-4">Author</th>
                                <th scope="col-8">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="author-col">
                                    <div>by
                                        @if (auth()->user()->is_admin != 0)
                                        {{-- if user is admin --}}
                                        
                                        <a href="{{ route('admin.show', $topic->user->id) }}" class="text-black text-decoration-none"> {{ $topic->user->name }}
                                            <img style="width: 30px; border: 1px solid #000;"
                                                src="{{ asset('storage/avatars/'.$topic->user->avatar) }}" alt=""></a>
                                        @else
                                        {{-- if user is not an admin --}}
                                        <a href="{{ route("user.show", $topic->user->id) }}" class="text-black text-decoration-none"> {{ $topic->user->name }}
                                            <img style="width: 30px; border: 1px solid #000;"
                                                src="{{ asset('storage/avatars/'.$topic->user->avatar) }}" alt=""></a>
                                        @endif
                                    </div>
                                </td>
                                <td class="post-col d-lg-flex justify-content-lg-between">
                                    <div>
                                        <span class="font-weight-bold">Subject:</span>
                                        <strong style="text-decoration: underline;">{{$topic->title}}</strong>
                                    </div>
                                    <div>
                                        <span class="font-weight-bold">Posted:
                                        </span>{{ $topic->created_at->diffForHumans()}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <span class="font-weight-bold">Joined:
                                        </span>{{ $topic->user->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td>
                                    <p>
                                        {{ $topic->desc }}
                                    </p>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="text-black p-2 mb-0"><div class="font-italic">'{{ $topic->title }}'</div> replies:</p>
                    @if (count($topic->replies) > 0)
                    @foreach ($topic->replies as $reply)
                    <table class="table table-striped table-responsivelg table-bordered">
                        <tbody>
                            <tr>
                                <td class="author-col">
                                    <div class="col-md-12 col-lg-6">by
                                        @if (auth()->user()->is_admin != 0)
                                        {{-- if user is admin --}}
                                    
                                        <a href="{{ route('admin.show', $reply->user->id) }}" class="text-black text-decoration-none"> {{ $reply->user->name }}
                                            <img style="width: 30px; border: 1px solid #000;"
                                                src="{{ asset('storage/avatars/'.$reply->user->avatar) }}" alt=""></a>
                                        @else
                                        {{-- if user is not an admin --}}
                                        @if (auth()->user()->id == $reply->user->id)
                                        <a href="{{route('home', auth()->user()->id)}}" class="text-black text-decoration-none"> {{ $reply->user->name }}
                                            <img style="width: 30px; border: 1px solid #000;"
                                                src="{{ asset('storage/avatars/'.$reply->user->avatar) }}" alt=""></a>
                                        @else
                                        <a href="{{route("user.show", $reply->user->id)}}" class="text-black text-decoration-none"> {{ $reply->user->name }}
                                            <img style="width: 30px; border: 1px solid #000;"
                                                src="{{ asset('storage/avatars/'.$reply->user->avatar) }}" alt=""></a>
                                        @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="post-col d-lg-flex justify-content-lg-between">
                                    <div class="col-md-12 col-lg-3">
                                        <span class="font-weight-bold">Post subject:</span><br>
                                        {{$topic->title}}
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <span class="font-weight-bold">Replied:</span><br>
                                        {{ $reply->created_at->diffForHumans() }}
                                    </div>
                                    
                                    @if (auth()->id() == $reply->user_id)
                                    <div class="col-md-12 col-lg-1">
                                        <a href="{{ route('reply.delete', $reply->id) }}" class="btn btn-danger">X</a>
                                    </div>

                                    @else
                                    <div class="col-md-12 col-lg-1">
                                        <a href="{{ route('reply.like', $reply->id) }}" class=" text-success"><i class="fa fa-thumbs-up"></i></a>
                                        <p class="mb-0 p-0">{{ $reply->likes }}</p>
                                        <a href="{{ route('reply.dislike', $reply->id) }}" class="text-danger"><i class="fa fa-thumbs-down"></i></a>
                                        
                                    </div>

                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <span class="font-weight-bold">Joined: </span>
                                        {{ $reply->user->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td>
                                    {{ $reply->desc }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                    @else
                    <h4>There are no replies in this topic</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="mb-3 clearfix">

    </div>
    <form action="{{ route('topic.reply', $topic->id)}} " method="POST" class="mb-3">
        @csrf
        <div class="form-group">
            <label for="comment" class="mb-0"><strong>Reply to {{$topic->user->name}}</strong></label>
            <textarea class="form-control" name="desc" id="" rows="10" required></textarea>
            <button type="submit" class="btn btn-primary mt-2 mb-lg-5">
                Submit reply
            </button>
            <button type="reset" class="btn btn-danger mt-2 mb-lg-5">
                Reset
            </button>
        </div>
    </form>

    {{-- Checks if the the user is logged in. 
      If not. He will get a prompt to log in if he wants to post and reply --}}
    @if ( !auth()->user() )
    <div>
        <div class="d-lg-flex align-items-center mb-3">
            <form method="POST" action="{{ route('login') }}" class="form-inline d-block d-sm-flex mr-2 mb-3 mb-lg-0">
                <div class="form-group mr-2 mb-3 mb-md-0">
                    <label for="email" class="mr-2">Email:</label>
                    <input type="email" class="form-control" placeholder="example@gmail.com" required />
                </div>

                <div class="form-group mr-2 mb-3 mb-md-0">
                    <label for="password" class="mr-2">Password:</label>
                    <input type="password" class="form-control" name="password" required />
                </div>

                <button class="btn btn-primary">Login</button>
            </form>
            <span class="mr-2">or...</span>
            <button class="btn btn-success">Create Account</button>
        </div>
    </div>
    <p class="small">
        <a href="#">Have you forgotten your account details?</a>
    </p>
    @endif


</div>
@endsection
