@extends('layouts.app')

@section('content')
@if (request('action') == 'delete' && $user)
    @can('delete', $user)
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">{{ __('user.delete') }} : {{ $user->name }}</h3></div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <tr><td>{{ __('user.name') }}</td><td>{{ $user->name }}</td></tr>
                            <tr><td>{{ __('user.nickname') }}</td><td>{{ $user->nickname }}</td></tr>
                            <tr><td>{{ __('user.gender') }}</td><td>{{ $user->gender }}</td></tr>
                            <tr><td>{{ __('user.father') }}</td><td>{{ $user->father_id ? $user->father->name : '' }}</td></tr>
                            <tr><td>{{ __('user.mother') }}</td><td>{{ $user->mother_id ? $user->mother->name : '' }}</td></tr>
                            <tr><td>{{ __('user.childs_count') }}</td><td>{{ $childsCount = $user->childs()->count() }}</td></tr>
                            <tr><td>{{ __('user.spouses_count') }}</td><td>{{ $spousesCount = $user->marriages()->count() }}</td></tr>
                            <tr><td>{{ __('user.managed_user') }}</td><td>{{ $managedUserCount = $user->managedUsers()->count() }}</td></tr>
                            <tr><td>{{ __('user.managed_couple') }}</td><td>{{ $managedCoupleCount = $user->managedCouples()->count() }}</td></tr>
                        </table>
                        @if ($childsCount + $spousesCount + $managedUserCount + $managedCoupleCount)
                            {{ __('user.replace_delete_text') }}
                            {{ Form::open([
                                'route' => ['users.destroy', $user],
                                'method' => 'delete',
                                'onsubmit' => 'return confirm("'.__('user.replace_confirm').'")',
                            ]) }}
                            {!! FormField::select('replacement_user_id', $replacementUsers, [
                                'label' => false,
                                'placeholder' => __('user.replacement'),
                            ]) !!}
                            {{ Form::submit(__('user.replace_delete_button'), [
                                'name' => 'replace_delete_button',
                                'class' => 'btn btn-danger',
                            ]) }}
                            {{ link_to_route('users.edit', __('app.cancel'), [$user], ['class' => 'btn btn-default pull-right']) }}
                            {{ Form::close() }}
                        @else
                            {!! FormField::delete(
                                ['route' => ['users.destroy', $user]],
                                __('user.delete_confirm_button'),
                                ['class' => 'btn btn-danger'],
                                ['user_id' => $user->id]
                            ) !!}
                            {{ link_to_route('users.edit', __('app.cancel'), [$user], ['class' => 'btn btn-default']) }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endcan
@else
    <div class="pull-right">
        {{ link_to_route('users.show', __('app.show_profile').' '.$user->name, [$user->id], ['class' => 'btn btn-default']) }}
    </div>
    <h2 class="page-header">
        {{ __('user.edit') }} {{ $user->profileLink() }}
    </h2>
    <div class="row">
        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' =>'patch', 'autocomplete' => 'off']) }}
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ __('user.edit') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::text('name', ['label' => __('user.name')]) !!}
                    {!! FormField::text('nickname', ['label' => __('user.nickname')]) !!}
                    <div class="row">
                        <div class="col-md-6">{!! FormField::radios('gender_id', [1 => __('app.male_code'), __('app.female_code')], ['label' => __('user.gender')]) !!}</div>
                        <div class="col-md-4">
                            {!! FormField::text('birth_order', ['label' => __('user.birth_order'), 'type' => 'number', 'min' => 1]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">{!! FormField::text('yob', ['label' => __('user.yob'), 'placeholder' => __('app.example').' 1959']) !!}</div>
                        <div class="col-md-6">{!! FormField::text('dob', ['label' => __('user.dob'), 'placeholder' => __('app.example').' 1959-07-20']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">{!! FormField::text('yod', ['label' => __('user.yod'), 'placeholder' => __('app.example').' 2003']) !!}</div>
                        <div class="col-md-6">{!! FormField::text('dod', ['label' => __('user.dod'), 'placeholder' => __('app.example').' 2003-10-17']) !!}</div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                {{ Form::submit(__('app.update'), ['class' => 'btn btn-primary']) }}
                {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-default']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ __('app.address') }} &amp; {{ __('app.contact') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::textarea('address', ['label' => __('app.address')]) !!}
                    {!! FormField::text('city', ['label' => __('app.city'), 'placeholder' => __('app.example').' Jakarta']) !!}
                    {!! FormField::text('phone', ['label' => __('app.phone'), 'placeholder' => __('app.example').' 081234567890']) !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ __('app.login_account') }}</h3></div>
                <div class="panel-body">
                    {!! FormField::email('email', ['label' => __('auth.email'), 'placeholder' => __('app.example').' nama@mail.com']) !!}
                    {!! FormField::password('password', ['label' => __('auth.password'), 'placeholder' => '******', 'value' => '']) !!}
                </div>
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
                    {!! FormField::file('photo', ['required' => true, 'label' => __('user.reupload_photo'), 'info' => ['text' => 'Format jpg, maks: 200 Kb.', 'class' => 'warning']]) !!}
                </div>
                <div class="panel-footer">
                    {!! Form::submit(__('user.update_photo'), ['class' => 'btn btn-success']) !!}
                    {{ link_to_route('users.show', __('app.cancel'), [$user], ['class' => 'btn btn-default']) }}
                </div>
                {{ Form::close() }}
            </div>
            @can('delete', $user)
                {{ link_to_route('users.edit', __('user.delete'), [$user, 'action' => 'delete'], ['class' => 'btn btn-danger pull-right', 'id' => 'del-user-'.$user->id]) }}
            @endcan
        </div>
    </div>
@endif
@endsection

@section('ext_css')
<link href="{{ asset('css/plugins/jquery.datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('script')
<script src="{{ asset('js/plugins/jquery.datetimepicker.js') }}"></script>
<script>
    (function() {
        $('#dob,#dod').datetimepicker({
            timepicker:false,
            format:'Y-m-d',
            closeOnDateSelect: true,
            scrollInput: false
        });
    })();
</script>
@endsection
