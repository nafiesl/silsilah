@extends('layouts.app')

@section('title', trans('user.edit'))

@section('content')
    <h2 class="page-header">
        @if (request('action') == 'delete' && $user)
        @can('delete', $user)
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ trans('app.delete') }}</h3></div>
                <div class="panel-body">
                    <label class="control-label">{{ trans('user.name') }}</label>
                    <p>{{ $user->name }}</p>
                    <label class="control-label">{{ trans('user.nickname') }}</label>
                    <p>{{ $user->nickname }}</p>
                    <label class="control-label">{{ trans('user.gender') }}</label>
                    <p>{{ $user->gender }}</p>
                    <label class="control-label">{{ trans('user.job') }}</label>
                    <p>{{ $user->job }}</p>
                    <label class="control-label">{{ trans('user.job_description') }}</label>
                    <p>{{ $user->job_description }}</p>
                    {!! $errors->first('id', '<span class="form-error small">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="panel-body">{{ trans('app.delete') }}</div>
                <div class="panel-footer">
                    {!! FormField::delete(
                        ['route' => ['users.destroy', $user]],
                        __('app.delete'),
                        ['class'=>'btn btn-danger'],
                        [
                            'id' => $user->id,
                            'page' => request('page'),
                            'q' => request('q'),
                        ]
                    ) !!}
                    {{ link_to_route('users.edit', trans('app.cancel'), [$user], ['class' => 'btn btn-default']) }}
                </div>
            </div>
        @endcan
        @else
        <div class="pull-right">
            {{ link_to_route('users.show', trans('app.show_profile').' '.$user->name, [$user->id], ['class' => 'btn btn-default']) }}
        </div>
        {{ trans('user.edit') }} {{ $user->profileLink() }}
    </h2>
    <div class="row">
        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' =>'patch', 'autocomplete' => 'off']) }}
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ trans('user.edit') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::text('name', ['label' => trans('user.name')]) !!}
                    {!! FormField::text('nickname', ['label' => trans('user.nickname')]) !!}
                    <div class="row">
                        <div class="col-md-6">{!! FormField::radios('gender_id', [1 => trans('app.male_code'), trans('app.female_code')], ['label' => trans('user.gender')]) !!}</div>
                        <div class="col-md-6">{!! FormField::text('dob', ['label' => trans('user.dob'), 'placeholder' => trans('app.example').' 1959-07-20']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">{!! FormField::text('yod', ['label' => trans('user.yod'), 'placeholder' => trans('app.example').' 2003']) !!}</div>
                        <div class="col-md-6">{!! FormField::text('dod', ['label' => trans('user.dod'), 'placeholder' => trans('app.example').' 2003-10-17']) !!}</div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ trans('app.login_account') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::email('email', ['label' => trans('auth.email'), 'placeholder' => trans('app.example').' nama@mail.com']) !!}
<!--                     {!! FormField::text('password', ['label' => trans('auth.password'), 'placeholder' => '******', 'value' => '']) !!} -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ trans('app.address') }} & {{ trans('app.contact') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::textarea('address', ['label' => trans('app.address')]) !!}
                    {!! FormField::text('city', ['label' => trans('app.city'), 'placeholder' => trans('app.example').' Jakarta']) !!}
                    {!! FormField::text('phone', ['label' => trans('app.phone'), 'placeholder' => trans('app.example').' 081234567890']) !!}
                    {!! FormField::text('job', ['label' => trans('user.job'), 'placeholder' => trans('app.example').' Karyawan']) !!}
                    {!! FormField::textarea('job_description', ['label' => trans('app.job_description')]) !!}
                </div>
            </div>
            <div class="text-right">
                {{ Form::submit(trans('app.update'), ['class' => 'btn btn-primary']) }}
                {{ link_to_route('users.edit', trans('app.delete'), [$user, 'action' => 'delete'], ['class' => 'btn btn-danger pull-center', 'id' => 'del-users-'.$user->id]) }}
                {{ link_to_route('users.show', trans('app.cancel'), [$user->id], ['class' => 'btn btn-default']) }}
            </div>
        </div>
        {{ Form::close() }}
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ __('user.update_photo') }}</h3></div>
                {{ Form::open(['route' => ['users.photo-upload', $user], 'method' => 'patch', 'files' => true]) }}
                <div class="panel-body text-center">
                    {{ userPhoto($user, ['style' => 'width:100%;max-width:300px']) }}
                </div>
                <div class="panel-body">
                    {!! FormField::file('photo', ['required' => true, 'label' => __('user.reupload_photo'), 'info' => ['text' => 'Format jpg, maks: 2 Mb.', 'class' => 'warning']]) !!}
                </div>
                <div class="panel-footer">
                    {!! Form::submit(__('user.update_photo'), ['class' => 'btn btn-success']) !!}
                    {{ link_to_route('users.show', trans('app.cancel'), [$user], ['class' => 'btn btn-default']) }}

                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endif
@endsection
