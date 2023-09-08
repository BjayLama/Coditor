@extends('layout.app')
@section('content')
    <div class="container">
        <section class="pt-50 pb-50 bg-gray">
            <div class="container">
                <div class="user-detail">
                    <div class="row pt-20">
                        <div class="row">
                            <div class="col-md-12 col-lg-10 offset-lg-1">
                                <form action="{{ route('student.update-profile') }}" method="POST">
                                    @csrf
                                    <div class="row account-info">
                                        <div class="col-sm-12">
                                            <h4 class="heading__subtitle username">
                                                User Name
                                            </h4>
                                        </div>
                                        <div class="col-sm-12">
                                            <h4 class="heading__subtitle">
                                                Account Information
                                            </h4>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">First Name</label>
                                            <input type="text" name="firstname" id="" value="{{ auth()->user()->firstname }}" class="form-control">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">Last Name</label>
                                            <input type="text" name="lastname" value="{{ auth()->user()->lastname}}" id="" class="form-control">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">User Name</label>
                                            <input type="text" name="username" value="{{ auth()->user()->username }}" id="" class="form-control">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">Email</label>
                                            <input type="text" value="{{ auth()->user()->email }}" id="" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone" id="" value="{{ auth()->user()->phone }}"  class="form-control">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">Country</label>
                                            <input type="text" name="country" id="" value="{{ auth()->user()->country }}" class="form-control">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">City</label>
                                            <input type="text" class="form-control" value="{{ auth()->user()->city }}" name="city">
                                        </div> 
                                    </div>
                                    <div class="submit-btn mt-20">
                                    <button class="btn btn__bordered btn__secondary btn__hover3" type="submit">
                                        Save Change
                                    </button>
                                    <a href="{{ route('student.student-dashboard') }}" class="btn btn__primary btn__hover3" id="" name="" value="">
                                        Cancel
                                    </a>
                                </div>
                                </form>
                                
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection