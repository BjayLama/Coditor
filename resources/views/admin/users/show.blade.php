@extends('admin/layout.header')
@section('content')
<div class="content-wrapper">
    
    <div class="container">
        <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Users Details</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}"> Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>UserName:</strong>
                        {{ $user->username }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Details:</strong>
                        {{ $user->password }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>FirstName:</strong>
                        {{ $user->firstname }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>LastName:</strong>
                        {{ $user->lastname }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Phone:</strong>
                        {{ $user->phone }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Country:</strong>
                        {{ $user->country }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>City:</strong>
                        {{ $user->city }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        {{ $user->description }}
                    </div>
                </div>
            </div>
    </div>
</div>


@endsection