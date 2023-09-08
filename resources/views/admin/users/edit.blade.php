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
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
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
            <h3 class="card-title">User registration</h3>
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
          <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
             <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Username:</strong>
                    <input type="text" name="username" value="{{ $user->username }}" class="form-control">
                </div>
            </div>
            <!-- <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                </div>
            </div> -->
            <div class="col-sm-12 col-md-6">
                <label for="">New Password</label>
                <input type="password" name="password" id="" value="{{ $user->password }}" class="form-control">
                <span>The password must have at least 8 character and have at least 1 digit(s), </span>
            </div>
            <!-- <div class="col-sm-12 col-md-6">
                <label for="">Confirm Password</label>
                <input type="password" name="" id="" class="form-control">
                <span>Password must be match as your new password </span>
            </div> -->
            <div class="col-sm-12 col-md-6">
                <label for="">First Name</label>
                <input type="text" name="firstname" id="" value="{{ $user->firstname }}" class="form-control">
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="">Last Name</label>
                <input type="text" name="lastname" id="" value="{{ $user->lastname }}" class="form-control">
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="">Email</label>
                <input type="email" name="email" id="" value="{{ $user->email }}" class="form-control">
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="">Phone Number</label>
                <input type="text" name="phone" id="" value="{{ $user->phone }}" class="form-control">
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="">Country</label>
                <input type="text" name="country" id="" value="{{ $user->country}}" class="form-control">
                <!-- <select name="country" id="" class="form-control" required>
                    <option value="" selected>Nepal</option>
                    <option value="">China</option>
                    <option value="">Dubai</option>
                    <option value="">Qatar</option>
                    <option value="">Newzealand</option>
                    <option value="">Australia</option>
                </select> -->
            </div>
            <div class="col-sm-12 col-md-6">
                    <label for="">City</label>
                    <input type="text" name="city" id="" value="{{ $user->city }}" class="form-control">
                    <!-- <select name="city" id="" class="form-control">
                        <option value="" selected>Kathmandu</option>
                        <option value="">Kathmandu</option>
                        <option value="">Kathmandu</option>
                        <option value="">Kathmandu</option>
                        <option value="">Kathmandu</option>
                        <option value="">Kathmandu</option>
                    </select> -->
            </div>
            <div class="col-sm-12">
              <label for="" class="form-group">Semester Inrolled</label>
              <select name="semester_id" id="" class="form-control">
                <option value="">None</option>

                <option value="1" {{ $user->semester_id == 1 ? 'selected' : '' }}>First Semester</option>

                <option value="2" {{ $user->semester_id == 2 ? 'selected' : '' }}>Second Semester</option>
                <option value="3" {{ $user->semester_id == 3 ? 'selected' : '' }}>Third Semester</option>
                <option value="4" {{ $user->semester_id == 4 ? 'selected' : '' }}>Fourth Semester</option>
                <option value="5" {{ $user->semester_id == 5 ? 'selected' : '' }}>Fifth Semester</option>
                <option value="6" {{ $user->semester_id == 6 ? 'selected' : '' }}>Sixth Semester</option>
              </select>
            </div>
            <div class="col-sm-12">
                <label for="" class="form-group">Role</label>
               <select name="role" id="" class="form-control">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
               </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
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