@extends('layout.app')
@section('content')


<section class="nopadding">
        <div class="page-detail">
            <div class="container">
                <div class="page-title">
                    {{ $assignment->title }}
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-title">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-title">
                        <a href="{{ route('course-single', ['slug' => $assignment->course_detail->slug]) }}">{{ $assignment->course_detail->coursename }}</a>
                    </li>
                    <li class="breadcrumb-title active">
                        <a href="javascript:void(0);">{{ $assignment->title }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="course-single-detail">
                <div class="back-link">
                    <a href="{{ route('assignment-details', ['slug' => $assignment->slug]) }}"> Go Back</a>
                </div>
                <div class="course-single-title">
                    {{ $assignment->title }}
                </div>
                
                <div class="course-single-desc">
                    The deadline for submission is {{ date('jS F, Y H:i:s', strtotime($assignment->deadline)) }}.
                </div>
                <form action="{{ route('submit-assignment',['slug' => $assignment->slug]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="submit-section">
                        <div class="submit-desc">
                            <div class="submit-type">
                                File Submission
                            </div>
                            <div class="submit-size">
                                Maximum submission file size: 150MB, maximum number of files: 15
                            </div>
                        </div>
                        <div class="submit-field">
                            <label for="submit-field"></label>
                            <div class="icon-image">
                                <img src="{{ asset('frontend/assets/images/icon/donwload.png') }}" alt="">
                            </div>
                            <input name="file" type="file" value="" id="submit-field" hidden>
                        </div>
                        <div class="submit-accept">
                            <strong>Accepted File types</strong>
                            <ul style="list-style-type: none;">
                                <li>PDF Document: <small>.pdf</small></li>
                                <li>Word Document: <small>.doc</small></li>
                                <li>Power-point: <small>.pptx</small></li>
                            </ul>
                        </div>
                        <div class="submit-btn">
                            <button class="btn btn__bordered btn__secondary btn__hover3" id="" name="" value="">
                                Save Change
                            </button>
                            <button class="btn btn__primary btn__hover3" id="" name="" value="">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection