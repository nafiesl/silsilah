@extends('layouts.app')

@section('content')
@if (request('action') == 'delete' && $user)
    @can('delete', $user)
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('users.partials.delete_confirmation')
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
        <div class="col-md-2">@include('users.partials.edit_nav_tabs')</div>
        <div class="col-md-10">
            <div class="row">
                {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' =>'patch', 'autocomplete' => 'off']) }}
                <div class="col-md-6">
                    @includeWhen(request('tab') == null || !in_array(request('tab'), ['death', 'contact_address', 'login_account',]), 'users.partials.edit_profile')
                    @includeWhen(request('tab') == 'death', 'users.partials.edit_death')
                    @includeWhen(request('tab') == 'contact_address', 'users.partials.edit_contact_address')
                    @includeWhen(request('tab') == 'login_account', 'users.partials.edit_login_account')
                    <div class="text-right">
                        {{ Form::submit(__('app.update'), ['class' => 'btn btn-primary']) }}
                        {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-default']) }}
                    </div>
                </div>
                {{ Form::close() }}
                <div class="col-md-6">
                    @includeWhen(request('tab') == null || !in_array(request('tab'), ['death', 'contact_address', 'login_account',]), 'users.partials.update_photo')
                </div>
            </div>
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
