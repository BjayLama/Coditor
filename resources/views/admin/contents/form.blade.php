@extends('admin/layout.header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Content Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Content Management</li>
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
            <h3 class="card-title">Content</h3>
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
        
        <div class="row clearfix">
            <div class="col-12">
                @php
                    $url = route('admin.contents.store');
                if (isset($content)){
                    $url = route('admin.contents.update', $content->id);
                }
                @endphp
                <form method="POST" action="{{ $url }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Title:</strong>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{isset($content->title)? $content->title:''}}" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Description</strong>
                            <textarea id="ckeditor" class="form-control" name="desc">{!! isset($content->desc) ?$content->desc:'' !!}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Course:</strong>
                            <select name="course" id="" class="form-control">
                              <option value=""></option>
                              @foreach ($data as $course)
                              <option {{ request()->routeIs('admin.contents.edit') && $content->course == $course->id ? 'selected' : '' }} value="{{ $course->id }}">{{ $course->coursename }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group">
                        @php($file = isset($report->file) && $report->file ? asset('storage/report/'.$report->slug.'/'.$report->file): '')
                            <strong>File:</strong>
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