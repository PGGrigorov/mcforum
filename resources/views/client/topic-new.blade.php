@extends('layouts.app')
@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a href="" class="breadcrumb-item"> Forum Categories</a>
        <a href="{{ route('category.overview', $frm->category->id)}}"
            class="breadcrumb-item">{{ $frm->category->title }}</a>
        <a href="#" class="breadcrumb-item">{{ $frm->title }}</a>
        <span class="breadcrumb-item active">New topic post</span>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-white bg-info mb-0 p-4 rounded">New topic post</h4>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('topic.store')}}" method="POST" class="mb-3">
        @csrf
        <div class="form-group">
            <label for="title">Topic Title</label>
            <input type="text" name="title" class="form-control" />
        </div>
        <div class="form-group">
            <label for="forum_id">Forum: </label>
            <select name="forum_id" class="forum-control" id="">
                @foreach ($forum as $fr)
                <option value="{{$fr->id}}">{{$fr->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="desc" id="" rows="10" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2 mb-lg-5">
            Create post
        </button>
        <button type="reset" class="btn btn-danger mt-2 mb-lg-5">Reset</button>
    </form>
    <div></div>

    @endsection
