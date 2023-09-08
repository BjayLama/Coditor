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

    <div class="add-btn mt-30">
        <button class="btn btn__bordered btn__secondary btn__hover3" id="" name="" value="">
            <a class="" href="{{ route('admin.contents.create') }}"> Add contents</a>
        </button>
    </div>
    <div class="container-fluid category-title mt-20">
    <!-- <div class="row">
        <div class="col-lg-12 margin-tb mt-20 mb-20">
            <div class="page-category-title">
                    contents Lists
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
                <th>ContentName</th>
                <th>Description</th>
                <th>Course</th>
                <th>File</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($contents as $key=> $content)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $content->title }}</td>
                <td>{{ $content->desc }}</td>
                <td>{{ $content->course }}</td>
                <td>
                {{ $content->file }}
                </td>
                <td style="text-align: center;" class="course-edit">
                    <a href="#contentView" data-bs-toggle="modal" data-bs-target="#contentView"
                        onclick='viewcontent("{{$content->title}}", "{{$content->desc}}")' data-title="VIEW" class="show"><i
                        class="fa fa-eye"></i></a>
                                            
                    <div class="hide">
                        <a href="{{route('admin.contents.edit',['slug'=>$content->slug])}}"
                            data-toggle="tooltip" data-title="EDIT"><i class="fa fa-edit"></i></a>
                    </div>
                    @csrf
                    <div class="delete">
                        <a href="#deletecontent" onclick="delete_content('{{ $content->id }}')" data-bs-toggle="modal" data-bs-target="#deletecontent">
                                    <span><i class="fas fa-trash-alt"></i></span>
                        </a>
                    </div>
                </td>
            </tr>
            
            @endforeach
        </table>
    </div>
</div>

<div class="modal fade" id="contentView" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Content Contents
                        <span id="viewDisplay"></span>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body pricing_page text-center pt-4 mb-4">
                    <div class="card ">
                        <div class="card-header">
                            <h5 id="title"></h5>
                        </div>
                        <div class="row card-body">
                            <div class="col-md-12" id="">
                                <b>Content:
                                    <br><span id="desc"></span></b>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal"
                        class="btn btn-outline-danger">Close
                </button>
                </div>
            </div>
            
        </div>
    </div>

<div class="modal fade" id="deletecontent" tabindex="-1" aria-labelledby="deletecontentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletecontentLabel">Delete</h5>
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
@endsection
@section('script')
    <script>
        function viewcontent(title, desc) {
            $("#contentView").modal('show');
            
            $("#title").html(title);
            $("#desc").html(desc);
               
        }

        function featured(id) {
            $.ajax({
                method: 'POST',
                url: "{{ route('admin.contents.featured') }}",
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

        function delete_content(id) {
            var conn = '/admin/contents/delete/' + id;
            $('#deletecontent a').attr("href", conn);
        }
    </script>
@endsection

