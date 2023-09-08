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
                        <a href="{{ route('home')}}">Home</a>
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
                                    <a href="{{ route('teacher.edit-profile-form')}}">
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
                </div>
            </div>
        </div>
    </section>

@endsection