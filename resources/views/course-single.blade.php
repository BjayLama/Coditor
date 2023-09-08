@extends('layout.app')
@section('content')
    <section class="nopadding">
        <div class="page-detail">
            <div class="container">
                <div class="page-title">
                {{ $course->coursename }}
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-title">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-title active">
                        <a href="javascript:void(0);">{{ $course->coursename }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="course-detail">
            <div class="course-detail-category">
                    <div class="course-detail-title">
                        <span>
                            <i class="fa fa-folder"></i>
                        </span>
                        Chapters
                    </div>
                    @foreach ($contents as $content )
                    <a href="{{ asset('storage/content/'.$content->slug.'/'.$content->file)}}" download>
                        <div class="course-detail-subtitle">
                            <span>
                                <i class="fa fa-file-pdf-o"></i>
                            </span>
                            {{$content->title}}
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="course-detail-category">
                    <div class="course-detail-title">
                        <span>
                            <i class="fa fa-folder"></i>
                        </span>
                        Assignment
                    </div>
                @foreach ($assignments as $assignment)
                <div class="pl-30 course-detail-category">
                    <div class="course-detail-title">
                        <a href="{{ route('assignment-details',['slug' => $assignment->slug]) }}">
                            <span>
                                <i class="fa fa-folder"></i>
                            </span>
                            {{$assignment->title}}
                        </a>
                    </div>
                    <div class="course-detail-subtitle">
                            <span>
                                <i class="fa fa-file-pdf-o"></i>
                            </span>
                            <a href="{{asset('storage/assignment/'.$assignment->slug.'/'.$assignment->file)}}" download>{{$assignment->file}}</a>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection