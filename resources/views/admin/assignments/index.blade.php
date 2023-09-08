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

    <div class="add-btn mt-30">
        <button class="btn btn__bordered btn__secondary btn__hover3" id="" name="" value="">
            <a class="" href="{{ route('admin.assignments.create') }}"> Add Assignments</a>
        </button>
    </div>
    <div class="container-fluid category-title mt-20">
        <!-- <div class="row">
        <div class="col-lg-12 margin-tb mt-20 mb-20">
            <div class="page-category-title">
                    assignments Lists
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
                <th>Assignment Name</th>
                <th>Course</th>
                <th>Semster</th>
                <th>Deadline</th>
                <th>Featured</th>
                <th>File</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($assignments as $key => $assignment)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $assignment->title }}</td>
                <td>{{ $assignment->course_detail->coursename }}</td>
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
                <td>{{ $semesters[$assignment->semester] }} Semester</td>
                @php
                    $deadline = date("jS F, Y H:i:s", strtotime($assignment->deadline));
                @endphp
                <td>{{ $deadline }}</td>
                <form action="" id="featuredForm">
                    @if($assignment->featured === 1)
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
                    <a class="btn btn-primary btn-sm" href="{{ asset('storage/assignment/'.$assignment->slug.'/'.$assignment->file) }}" download><i class="fa fa-download"></i> Download</a>
                </td>
                <td style="text-align: center;" class="course-edit">
                    
                    <a href="#assignmentView" data-bs-toggle="modal" data-bs-target="#assignmentView"
                        onclick='viewAssignment("{{$assignment->slug}}", "{{$assignment->title}}", "{{$assignment->desc}}", "{{$assignment->featured}}", "{{$assignment->course_detail->coursename}}", "{{$assignment->file}}","{{ $deadline }}")'
                        data-title="VIEW" class="show"><i class="fa fa-eye"></i></a>

                    <div class="hide">
                        <a href="{{route('admin.assignments.edit',['slug'=>$assignment->slug])}}" data-toggle="tooltip"
                            data-title="EDIT"><i class="fa fa-edit"></i></a>
                    </div>
                    @csrf
                    <!-- @method('DELETE') -->
                    <div class="delete">
                        <a href="#deleteassignment" onclick="delete_assignment('{{ $assignment->id }}')" data-bs-toggle="modal" data-bs-target="#deleteassignment">
                            <span><i class="fas fa-trash-alt"></i></span>
                        </a>
                    </div>
                </td>
            </tr>

            @endforeach
        </table>
    </div>
</div>

<div class="modal fade" id="assignmentView" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Assignment Contents
                    <span id="viewFeatured"></span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pricing_page text-center pt-4 mb-4">
                <div class="card ">
                    <div class="card-header">
                        <h5 id="title"></h5>
                    </div>
                    <div class="card-body">
                        <p>Course : <strong id="course"></strong></p>
                        <p>Deadline : <strong id="deadline"></strong></p>
                        <p>Description : <span id="desc"></span> </p>
                    </div>
                    
                </div>
            </div>
            <br>
            <div class="modal-footer">
            <a type="button" data-bs-dismiss="modal" aria-label="Close"
                    class="btn btn-outline-danger">Close
            </a>
        </div>
        </div>
        
    </div>
</div>

<div class="modal modal-primary fade" id="deleteassignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete assignment</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to delete assignment?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-round btn-primary" data-bs-dismiss="modal">Cancel</button>
                <a class="btn btn-round btn-danger" href="">Delete It!</a>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        function viewAssignment(slug, title, desc, featured, course, file, deadline) {
            $("#assignmentView").modal('show');
            $("#title").html(title);
            $("#desc").html(desc);
            $("#course").html(course);
            $("#deadline").html(deadline);
            if (featured == 0) {
                $('#viewFeatured').html('<small class="badge badge-danger">Not Featured</small>');
            } else {
                $('#viewFeatured').html('<small class="badge badge-success">Featured</small>');
            }
            $('#ViewFile').attr('src', "{{ asset('storage/assignment/')}}/" + slug + "/thumbs/cover_" + file);        
        }

        function featured(id) {
            $.ajax({
                method: 'POST',
                url: "{{ route('admin.assignments.featured') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    if (obj.success) {
                        toastr.success(obj.success);
                        setTimeout(function () {
                            location.reload();  //Refresh page
                        }, 100);
                    } else if (obj.error) {
                        toastr.error(obj.error);
                    }
                },
                error: function (response){
                    console.log(response);
                }
            })
        }

        function delete_assignment(id) {
            // alert(file);
            var conn = '/admin/assignments/delete/' + id;
            $('#deleteassignment a').attr("href", conn);
        }
    </script>
@endsection

