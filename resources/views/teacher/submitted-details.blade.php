@extends('layout.app')
@section('content')
<section class="nopadding">
        <div class="page-detail">
            <div class="container">
                <div class="page-title">
                    Assignment Submission
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-title">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-title active">
                        <a href="javascript:void(0);">Assignment Submission</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

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
                            Submit Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Bijay Tamang
                        </td>
                        <td>
                            Assignment.pdf
                        </td>
                        <td>
                            Submitted
                        </td>
                        <td>
                            02-11-2022
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Bijay Tamang
                        </td>
                        <td>
                            Assignment.pdf
                        </td>
                        <td>
                            Not Submitted
                        </td>
                        <td>
                            02-11-2022
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection