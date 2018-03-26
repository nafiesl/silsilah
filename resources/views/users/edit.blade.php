@extends('layouts.app')

@section('content')
    <h2 class="page-header">
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
                    <div class="text-center">
                        @if ($user->photo_path && is_file(public_path('storage/'.$user->photo_path)))
                            {{ Html::image('storage/'.$user->photo_path, $user->name, ['style' => 'max-width:100%']) }}
                        @else
                            {{ Html::image('images/icon_user_'.$user->gender_id.'.png', $user->name, ['style' => 'max-width:100%']) }}
                        @endif
                    </div>
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
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ trans('app.address') }} & {{ trans('app.contact') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::textarea('address', ['label' => trans('app.address')]) !!}
                    {!! FormField::text('city', ['label' => trans('app.city'), 'placeholder' => trans('app.example').' Jakarta']) !!}
                    {!! FormField::text('phone', ['label' => trans('app.phone'), 'placeholder' => trans('app.example').' 081234567890']) !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ trans('app.login_account') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::email('email', ['label' => trans('auth.email'), 'placeholder' => trans('app.example').' nama@mail.com']) !!}
                    {!! FormField::text('password', ['label' => trans('auth.password'), 'placeholder' => '******', 'value' => '']) !!}
                </div>
            </div>
            <div class="text-right">
                {{ Form::submit(trans('app.update'), ['class' => 'btn btn-primary']) }}
                {{ link_to_route('users.show', trans('app.cancel'), [$user->id], ['class' => 'btn btn-default']) }}
            </div>
        </div>
        {{ Form::close() }}
        <div class="col-md-4">
            {{ Form::open(['route' => ['users.photo-upload', $user], 'method' => 'patch', 'files' => true]) }}
            {!! FormField::file('photo', ['required' => true, 'label' => __('user.reupload_photo'), 'info' => ['text' => 'Format jpg, maks: 200 Kb.', 'class' => 'warning']]) !!}
            {!! Form::submit(__('user.update_photo'), ['class' => 'btn btn-success']) !!}
            {{ link_to_route('users.show', trans('app.cancel'), [$user], ['class' => 'btn btn-default']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
