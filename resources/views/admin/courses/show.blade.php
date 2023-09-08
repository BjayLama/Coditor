@extends('admin/layout.header')
@section('content')

<div class="content-wrapper">
    <div class="container">
        <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Course Details</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}"> Home</a>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>courseName:</strong>
                        {{ $course->coursename }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Description:</strong>
                        {{ $course->coursedetail }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Semester:</strong>
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
                    {{ $semesters[$course->semester] }} Semester
                    </div>
                </div>
               
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Featured:</strong>
                        {{ $course->featured }}
                    </div>
                </div>
            </div>
    </div>
</div>


@endsection