@extends('layout.app')
@section('content')

<div class="container-fluid pl-50 pr-50 mt-20">
        <div class="row">
            <div class="col-md-8 offset-md-1">
                <div class="recent-access">
                    <div class="row">
                        <div class="recent__title">
                            Recent Access Courses
                        </div>
                       
                        @foreach($featured_courses as $course)
                        <div class="col-md-4 mb-20">
                            <a href="{{ route('course-single',$course->slug )}}">
                                <div class="card">
                                    <div class="img-card"><img src="{{ asset('storage/course/'.$course->slug.'/' .$course->image) }}" class="card-img-top" alt=""></div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->coursename}}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="course-view">
                    <div class="course__title">
                        Courses Overview
                    </div>
                    <div class="row text-center">
                    <?php $data = App\Course::where('semester', auth()->user()->semester_id)->get();?>
                    @foreach($data as $course)
                        <div class="col-md-4 mb-20">
                            <a href="{{ route('course-single',$course->slug )}}">
                                <div class="card">
                                    <div class="img-card"><img src="{{ asset('storage/course/'.$course->slug.'/' .$course->image) }}" class="card-img-top" alt=""></div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->coursename}}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12">
                        <div class="timeline-section">
                            <div class="">
                                <div class="title timeline__title">
                                    Time Line
                                </div>
                                <?php $assignments=App\Assignment::orderBy('created_at', 'DESC')->where('semester', auth()->user()->semester_id)->limit(5)->get(); ?>
                                @foreach($assignments as $assignment)
                                <div class="time-line">
                                    <div class="meta-date">
                                    {{ \Carbon\Carbon::parse($assignment->deadline)->format('M d, Y') }}
                                    </div>
                                    <div class="timeline-event">
                                        <span>
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <div class="event-title">
                                            <a href="{{ route('assignment-details',['slug' => $assignment->slug]) }}">{{$assignment->title}}</a>
                                            <div class="event-subtitle">
                                                {{$assignment->course_detail->coursename}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    </div>
@endsection