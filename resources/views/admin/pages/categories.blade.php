@extends('layouts.dashboard')

@section('content')
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">

              <!--overview start-->
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i> Forum Categories</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                <li><i class="fa fa-users"></i>Categories</li>
              </ol>
            </div>
          </div>

          <div class="row">

            <div class="col-lg-12 col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2><i class="fa fa-flag-o red"></i><strong>Forum Categories</strong></h2>
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
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($categories)> 0)
                            @foreach ($categories as $cat)
                            <tr>
                                <td>{{$cat->title}}</td>
                                <td><img src="{{asset('storage/images/categories/'.$cat->image)}}" style="width:50px; height:50px;" alt=""></td>
                                <td>{!!$cat->desc!!}</td>
                                <td>
                                  <a href="{{ route('category',$cat->id) }}">
                                    <i class="fa fa-eye text-success"></i>
                                  </a>
                                </td>
                                <td>
                                  <a href="{{ route('category.edit', $cat->id) }}">
                                    <i class="fa fa-edit text-info"></i>
                                  </a>
                                </td>
                                <td><a href="{{ route('category.destroy', $cat->id) }}" class="text-danger"><i class="fa fa-trash"></i></a></td>
                              </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>

                  {{ $categories->links() }}
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