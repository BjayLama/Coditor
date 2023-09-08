@extends ('layout.app')
@section ('content')

    <div class="container">
        <section class="pl-50 pr-50">
            <div class="course-view">
                    <div class="course__title">
                        <span>
                            <i class="fa fa-book"></i>
                        </span>
                        Courses
                    </div>
                <div class="row text-center">
                    @foreach($search as $course)
                    <div class="col-md-4 mb-20">
                        <a href="{{ route('course-single',$course->slug )}}">
                            <div class="card">
                            <div class="img-card"><img src="{{ asset('storage/course/'.$course->slug.'/' .$course->image) }}" class="card-img-top" alt=""></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $course->coursename }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="course-detail-category">
                    <div class="course-detail-title">
                        <span>
                            <i class="fa fa-folder"></i>
                        </span>
                        Assignments
                    </div>
                    @foreach($searchassignment as $assignment)
                    <div class="course-detail-subtitle">
                        <span>
                            <i class="fa fa-folder"></i>
                        </span>
                        <a href="{{ route('assignment-details',['slug' => $assignment->slug]) }}">{{ $assignment->title }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div> 

@endsection