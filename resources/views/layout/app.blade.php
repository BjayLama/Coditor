<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coditor | Home</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.css')}}">
        <!-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css')}}"> -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/custom.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/responsive_custom.css')}}">
</head>

<body>
    <header>
        <div class="header-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="nav-brand">
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('frontend/assets/images/logo/logo.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="brand__title">
                                    <a href="{{ route('home') }}">Coditor | Easy Learning</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="header-search">
                            <form action="{{ route('search') }}" method="GET">
                                <input type="text" name="search" class="form-control" id="">
                                <button type="submit" class="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="user">
                            <div class="user-name">
                            <p class="detail">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</p>
                            </div>
                            <div class="user-icon">
                                    <a href="{{ Auth::user()->hasRole('teacher') ? route('teacher.teacher-dashboard') : route('student.student-dashboard') }}"><i class="fa fa-user-circle-o"></i></a>
                            </div>
                            <div class="user-notice" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <a href="javascript:void(0)"><i class="fa fa-sign-out"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler" type="button">
                    <span class="menu-lines"><span></span></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavigation">
                <a href="{{ route('code')}}" class="btn btn-primary mt-10 mr-20">Code</a>
                    <ul class="navbar-nav mr-30 ml-auto">
                    
                    <?php $courses = App\Course::where('semester', auth()->user()->semester_id)->get();?>
                        @foreach($courses as $course)
                        <li class="nav__item with-dropdown">
                            <a href="{{ route('course-single',$course->slug )}}"  class="dropdown-toggle nav__item-link">{{ $course->coursename }}</a>
                        </li>
                        @endforeach
                    </ul><!-- /.navbar-nav -->
                </div><!-- /.navbar-collapse -->
                
            </div><!-- /.container -->
        </nav><!-- /.navabr -->

        </div>
    </header>



      <!-- Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to logout !!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="{{ route('logout') }}" id="user-logout" class="btn btn-primary">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </div>
    </div>
  </div>


  <script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>
  <script>
  $(document).ready(function(){
    $("#user-logout").click(function (e) {
        e.preventDefault();
        $("#logout-form").submit();
    });
  });
</script>








    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


</body>



</html>