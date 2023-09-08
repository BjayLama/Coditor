@extends('admin/layout.header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assignment Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Assignment Management</li>
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
            <h3 class="card-title">Assignment</h3>
          </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <label>Whoops!</label> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="row clearfix">
            <div class="col-12">
                @php
                    $url = route('admin.assignments.store');
                if (isset($assignment)){
                    $url = route('admin.assignments.update', $assignment->id);
                }
                @endphp
                <form method="POST" action="{{ $url }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{isset($assignment->title)? $assignment->title:''}}" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="ckeditor" class="form-control" name="desc">
                                {!! isset($assignment->desc) ? $assignment->desc:'' !!}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Semester:</label>
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
                            <label>Course:</label>
                            <select name="course" id="" class="form-control">
                              @foreach ($data as $course)
                              <option {{ request()->routeIs('admin.assignments.edit') && $assignment->course == $course->id ? 'selected' : '' }} value="{{ $course->id }}">{{ $course->coursename }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Deadline:</label>
                            <input type="datetime-local" name="deadline" class="form-control" id="" value="{{isset($assignment->deadline)?$assignment->deadline:''}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Display:</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <input type="checkbox" name="featured" {{isset($assignment->featured) && $assignment->featured == 1 ? 'checked' : ''}} ></span>
                                    <input type="text" class="form-control" value="Display Featured" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group">
                        @php($file = isset($report->file) && $report->file ? asset('storage/report/'.$report->slug.'/'.$report->file): '')
                            <label>File:</label>
                            <input type="file" class="form-control dropify" data-height="200" name="file">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
                </form>
            </div>

        </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection