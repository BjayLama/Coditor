@extends('admin/layout.header')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- ./col -->
            <div class="col-lg-4 col-6">
                <div class="small-box bg-light">
                    <div class="inner">
                    <a href="{{ route('admin.users.list') }} ">
                      <div class="title-icon">
                        <i class="fa fa-user"></i>
                      </div>
                        <p class="model_title">
                            User Management
                        </p>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-light">
                    <div class="inner">
                      <a href="{{ route('admin.courses.index') }}">
                        <div class="title-icon">
                          <i class="fas fa-book"></i>
                        </div>
                          <p class="model_title">
                              Course Management
                          </p>
                      </a>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-light">
                    <div class="inner">
                        <a href="{{ route('admin.assignments.index') }}">
                          <div class="title-icon">
                            <i class="fas fa-file"></i>
                          </div>
                          <p class="model_title">
                              Assignment Management
                          </p>
                        </a>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-light">
                    <div class="inner">
                        <a href="{{ route('admin.contents.index') }}">
                          <div class="title-icon">
                          <i class="fas fa-file-alt"></i>
                          </div>
                          <p class="model_title">
                              Content Management
                          </p>
                        </a>
                        
                    </div>
                </div>
            </div>
            
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection