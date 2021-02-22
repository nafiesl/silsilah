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
