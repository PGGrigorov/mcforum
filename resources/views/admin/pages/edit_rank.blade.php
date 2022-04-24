<?php
use Illuminate\Support\Facades\Session;
?>
@extends('layouts.dashboard')

@section('content')
          <!--main content start-->
       
          
    <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-edit"></i>Edit Rank</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                <li><i class="fa fa-ranking-srar"></i>Rank</li>
              <li><i class="fa fa-plus"></i>Add</li>
              </ol>
            </div>
          </div>


          <!-- edit-profile -->
<div id="edit-profile" class="tab-pane">
  <section class="panel">
    <div class="panel-body bio-graph-info">
        @if (session()->has('errors'))
            @foreach ($errors as $error)
                {{$error}}
            @endforeach
        @endif
      @if(\Session::has('message'))

      <p class="alert
      {{ Session::get('alert-class', 'alert-success') }}">{{Session::get('message') }}</p>
      
      @endif

      @if ($rank) 
      <form class="form-horizontal" method="POST" action="{{ route('ranks.update', $rank->id)}}" enctype="multipart/form-data">
          @csrf
      
        <div class="form-group">
          <label class="col-lg-2 control-label">Rank Title</label>
          <div class="col-lg-10">
          <input name="title" class="form-control" value="{{$rank->name}}"/>
          </div>
        </div>
        {{-- Error for missing category title --}}
        @error('title')
            <p class="alert alert-danger">{{$message}}</p>
        @enderror


        <div class="form-group">
            <label class="col-lg-2 control-label">Rank Image</label>
            <div class="col-lg-10">
            <input type="file" name="badge" class="form-control" />
            <img src="{{asset('storage/images/ranks/'.$rank->badge)}}" style="width: 50px; height:50px;" alt="">
            </div>
          </div>
          {{-- Error for missing category image --}}
          @error('image')
          <p class="alert alert-danger">{{$message}}</p>
         @enderror
        

        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="/dashboard/home" class="btn btn-danger">Cancel</a>
          </div>
        </div>
      </form>
      @endif
    </div>
  </section>
</div>


        </section>
      </section>
      <!--main content end-->
      
@endsection
