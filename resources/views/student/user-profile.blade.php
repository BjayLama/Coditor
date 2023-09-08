@extends('layout.app')
@section('content')


<section class="nopadding">
        <div class="page-detail">
            <div class="container">
                <div class="page-title">
                    My Account
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-title">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-title active">
                        <a href="javascript:void(0);">Account Inforamtion</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="pt-50 pb-50 bg-gray">
        <div class="container">
            <div class="user-detail">
                <!-- <div class="detail-heading">
                    <h2 class="heading__title">My Account</h2>
                    <a href="#" class="btn btn__bordered btn__secondary btn__hover3 right">Edit-Info</a>
                </div> -->
                <div class="row pt-20">
                    <div class="col-md-6">
                        <div class="row account-info">
                            <div class="col-sm-12">
                                <div class="edit-profile">
                                    <a href="{{ route('student.edit-profile-form')}}">
                                        Edit-profile
                                    </a>
                                </div>
                                <h4 class="heading__subtitle">
                                    Account Information
                                </h4>
                                
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Name</label>
                                <p class="detail">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">User Name</label>
                                <p class="detail">{{ auth()->user()->username }}</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Email</label>
                                <p class="detail">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Phone Number</label>
                                <p class="detail">{{ auth()->user()->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-detail">
                            <h4 class="heading__subtitle">
                                Course Detail
                            </h4>
                            <div class="details">
                                <ul>
                                    <?php $courses = App\Course::where('semester', auth()->user()->semester_id)->get();?>
                                    @foreach($courses as $course)
                                    <li>
                                        <a href="javascript:void(0);">{{ $course->coursename }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="row login-activity">
                            <div class="col-sm-12">
                                <h4 class="heading__subtitle">
                                   Log-in information
                                </h4>
                                <div class="activity-detail">
                                    First access to site
                                </div>
                                <div class="activity-subdetail">
                                    Friday, 17 April 2020, 9:24 AM  (1 year 229 days)
                                </div>
                                <div class="activity-detail">
                                    Recent access to site
                                </div>
                                <div class="activity-subdetail">
                                    Friday, 17 April 2020, 9:24 AM  (15sec)
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

@endsection