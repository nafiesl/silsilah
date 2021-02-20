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
        <div class="col-md-2">@include('users.partials.edit_nav_tabs')</div>
        <div class="col-md-10">
            <div class="row">
                {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' =>'patch', 'autocomplete' => 'off']) }}
                <div class="col-md-6">
                    @includeWhen(request('tab') == null, 'users.partials.edit_profile')
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
                    @includeWhen(request('tab') == null, 'users.partials.update_photo')
                    @if (request('tab') == null)
                        @can('delete', $user)
                            {{ link_to_route('users.edit', __('user.delete'), [$user, 'action' => 'delete'], ['class' => 'btn btn-danger pull-right', 'id' => 'del-user-'.$user->id]) }}
                        @endcan
                    @endif
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
