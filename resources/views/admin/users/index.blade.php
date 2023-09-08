@extends('admin/layout.header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <div class="add-btn mt-30">
        <button class="btn btn__bordered btn__secondary btn__hover3" id="" name="" value="">
            <a class="" href="{{ route('admin.users.create') }}"> Add users</a>
        </button>
    </div>
    <div class="container-fluid category-title mt-20">
    <!-- <div class="row">
        <div class="col-lg-12 margin-tb mt-20 mb-20">
            <div class="page-category-title">
                    Users Lists
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
            <th>UserName</th>
            <th>Password</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Role</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->password }}</td>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <form action="{{ route('admin.users.create',$user->id) }}" method="POST">
                    <div class="course-edit">
                        <div class="edit">
                        <a class="" href="{{ route('admin.users.show',$user->id) }}">
                        <span>
                            <i class="fa fa-eye"></i>
                            </span>
                        </a>
                        </div>
                        <div class="hide">
                        <a class="" href="{{ route('admin.users.edit',$user->id) }}">
                            <span>
                                <i class="fa fa-cog"></i>
                            </span>
                        </a>
                        </div>
                        @csrf
                        <!-- @method('DELETE') -->
                        <div class="delete">
                            <a href="#deleteuser" onclick="delete_user('{{ $user->id }}')" data-bs-toggle="modal" data-bs-target="#deleteuser">
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

<!-- Modal -->
<div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="deleteuserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteuserLabel">Delete User</h5>
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
  function delete_user(id) {
    //   alert(file);
      var conn = '/admin/users/delete/' + id;
      $('#deleteuser a').attr("href", conn);
  }
</script>
@endsection