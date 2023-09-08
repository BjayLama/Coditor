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

    <div class="add-btn mt-30">
        <button class="btn btn__bordered btn__secondary btn__hover3" id="" name="" value="">
            <a class="" href="{{ route('admin.courses.create') }}"> Add courses</a>
        </button>
    </div>
    <div class="container-fluid category-title mt-20">
    <!-- <div class="row">
        <div class="col-lg-12 margin-tb mt-20 mb-20">
            <div class="page-category-title">
                    courses Lists
            </div>
        </div>
    </div> -->

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>
                {{ $message}}
            </p>
        </div>
    @endif

    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>courseName</th>
            <th>Description</th>
            <th>Semester</th>
            <th>Featured</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $course)
        <tr>
            <td>{{ $key+1 }}</td>
            <td class="w60">
                <div class="avtar-pic w50 bg-red" data-toogle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">
                <span><img src="{{asset('storage/course/'.$course->slug.'/' .$course->image)}}"
                                                    class="img-thumbnail"></span>

            </td>
            <td>{{ $course->coursename }}</td>
            <td>{{ $course->coursedetail }}</td>
            @php
                $semesters = [
                            '1' => 'First',
                            '2' => 'Second',
                            '3' => 'Third',
                            '4' => 'Fourth',
                            '5' => 'Fifth',
                            '6' => 'Sixth'
                        ];
            @endphp
            <td> {{ $semesters[$course->semester] }} Semester</td>
            <form action="" id="statusForm">
            @if($course->featured === 1)
                    <td class="text-center">
                        <span class="badge badge-success">Featured</span>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="badge badge-danger">Not Featured</span>
                    </td>
                    @endif
                    </form>
            <td>
                <form action="{{ route('admin.courses.create') }}" method="POST">
                    <div class="course-edit">
                        <div class="edit">
                        <a class="" href="{{ route('admin.courses.show',$course->id) }}">
                        <span>
                            <i class="fa fa-eye"></i>
                            </span>
                        </a>
                        </div>
                        <div class="hide">
                        <a class="" href="{{ route('admin.courses.edit',$course->id) }}">
                            <span>
                                <i class="fa fa-cog"></i>
                            </span>
                        </a>
                        </div>
                        @csrf
                        <!-- @method('DELETE') -->
                        <div class="delete">
                        <a href="#deletecourse" onclick="delete_course('{{ $course->id }}')" data-bs-toggle="modal" data-bs-target="#deletecourse">
                            <span><i class="fas fa-trash-alt"></i></span>
                        </a>
                        </div>
                    </div>
                    <!-- @csrf
                    @method('DELETE') -->

                </form>
            </td>
        </tr>
        
        @endforeach
    </table>
</div>
</div>

<div class="modal fade" id="deletecourse" tabindex="-1" aria-labelledby="deletecourseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletecourseLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you Sure ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-default" data-bs-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-round btn-primary">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    function delete_course(id) {
            // alert(file);
            var conn = '/admin/courses/delete/' + id;
            $('#deletecourse a').attr("href", conn);
        }
</script>

@endsection