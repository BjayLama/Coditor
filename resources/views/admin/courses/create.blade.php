@extends('admin/layout.header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Course Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Course Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Course registration</h3>
          </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
          <!-- /.card-header -->
          <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                            <strong>Image:</strong>
                            <input type="file" name="image" class="form-control dropify" data-height="200" placeholder="image">
                          </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Course Name:</strong>
                            <input type="text" name="coursename" class="form-control" placeholder="CourseName">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Semester:</strong>
                           <select name="semester" id="" class="form-control">
                              <option value="1">First Semester</option>
                              <option value="2">Second Semester</option>
                              <option value="3">Third Semester</option>
                              <option value="4">Fourth Semester</option>
                              <option value="5">Fifth Semester</option>
                              <option value="6">Sixth Semester</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <input type="checkbox" name="featured" {{isset($course->featured) && $course->featured == 1 ? 'checked' : ''}} ></span>
                                    <input type="text" class="form-control" value="Display Featured" disabled>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="" class="form-group">Description</label>
                        <textarea name="coursedetail" id="" class="form-control" cols="" rows="5"></textarea>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
          </div>
          </form>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection