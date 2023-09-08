@extends ('layout.app')
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

    @if(Auth::user()->hasRole('teacher'))
    <section class="mt-40 mb-30">
        <div class="container">
            <table class="submit-table">
                <thead>
                    <tr>
                        <th>
                            Student Name
                        </th>
                        <th>
                            File
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Submitted Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $key => $submission)
                    <tr>
                        <td>
                            {{ $submission->student->firstname }} {{ $submission->student->lastname }}
                        </td>
                        <td>
                            <a href="{{ asset('storage/submission/'.$submission->file) }}" download>{{ $submission->file }}</a>
                        </td>
                        <td>
                            Submitted
                        </td>
                        <td>
                            {{ date('jS F, Y H:i:s', strtotime($submission->created_at)) }}
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </section>
    @elseif(Auth::user()->hasRole('student'))
    <section>
        <div class="container">
            <div class="course-single-detail">
                <div class="back-link">
                    <a href="{{ route('course-single', ['slug' => $assignment->course_detail->slug]) }}"> Go Back</a>
                </div>
                <div class="course-single-title">
                    {{ $assignment->title }}
                </div>
                @if(isset($submission))
                <div class="course-single-desc">
                    <a href="{{ asset('storage/submission/'.$submission->file)}}"> 
                        {{ $submission->file }}
                    </a>
                </div>
                @endif
                <div class="submit-status">
                    Submision Status
                </div>
                <div class="submission-table">
                    <table>
                        <tbody>
                            <tr>
                                <th>
                                    Submission Status
                                </th>
                                <td>
                                    {{ isset($submission) ? 'Submitted' : 'No attempt' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Grading Status
                                </th>
                                <td>
                                    No graded
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Due Date
                                </th>
                                <td>
                                    {{ date('jS F, Y H:i:s', strtotime($assignment->deadline)) }}
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>
                                    Time Remaining
                                </th>
                                <td>
                                    5 days 5 hours
                                </td>
                            </tr> -->
                            <tr>
                                <th>
                                    Last Modified
                                </th>
                                <td>
                                    {{ isset($submission) ?  date('jS F, Y H:i:s', strtotime($submission->updated_at )) : 'Not Submitted' }}
                                    <!-- {{ date('jS F, Y H:i:s', strtotime($assignment->created_at )) }}    -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-20 submit-comment">
                        <div class="comment">
                        {{ isset($submission) ? 'You Have Submitted' : 'You have Not Submitted' }}
                        </div>
                        @if(date('Y-m-d H:i:s',strtotime($assignment->deadline)) >= date('Y-m-d H:i:s'))
                        <a href="{{ route('submission-single',['slug' => $assignment->slug]) }}" class="btn btn__bordered btn__secondary btn__hover3" id="" name="" value="">Add
                            Submission
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection