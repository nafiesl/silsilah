@extends('layouts.app')

@section('content')
    <h2 class="page-header">
        <div class="pull-right">
            {{ link_to_route('users.show', trans('app.show_profile').' '.$user->name, [$user->id], ['class' => 'btn btn-default']) }}
        </div>
        Change Password
    </h2>
    <div class="row">
        {{ Form::open(['route' => ['users.password'], 'method' =>'patch', 'autocomplete' => 'off']) }}
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Change Password</h3></div>
                <div class="panel-body">
                    {!! FormField::password('old_password', ['label' => 'Old Password']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                    {!! FormField::password('new_password', ['label' => 'New Password']) !!}
                    {!! FormField::password('new_password_confirmation', ['label' => 'New Password Confirm']) !!}
                </div>
                <div class="panel-footer">
                    {!! Form::submit(__('user.password'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
