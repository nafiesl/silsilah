<div class="panel panel-default">
    <div class="panel-heading">
        @can ('edit', $user)
        <div class="pull-right" style="margin: -3px -6px">
            {{ link_to_route('users.show', __('user.add_child'), [$user->id, 'action' => 'add_child'], ['class' => 'btn btn-success btn-xs']) }}
        </div>
        @endcan
        <h3 class="panel-title">{{ __('user.childs') }} ({{ $user->childs->count() }})</h3>
    </div>

    <ul class="list-group">
        @forelse($user->childs as $child)
            <li class="list-group-item">
                {{ $child->profileLink() }} ({{ $child->gender }})
            </li>
        @empty
            <li class="list-group-item">{{ __('app.childs_were_not_recorded') }}</li>
        @endforelse
        @can('edit', $user)
        @if (request('action') == 'add_child')
        <li class="list-group-item">
            {{ Form::open(['route' => ['family-actions.add-child', $user->id]]) }}
            <div class="row">
                <div class="col-md-8">
                    {!! FormField::text('add_child_name', ['label' => __('user.child_name')]) !!}
                </div>
                <div class="col-md-4">
                    {!! FormField::radios('add_child_gender_id', [1 => __('app.male'), 2 => __('app.female')], ['label' => __('user.child_gender')]) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    {!! FormField::select('add_child_parent_id', $usersMariageList, ['label' => __('user.add_child_from_existing_couples', ['name' => $user->name]), 'placeholder' => __('app.unknown')]) !!}
                </div>
                <div class="col-md-4">
                    {!! FormField::text('add_child_birth_order', ['label' => __('user.birth_order'), 'type' => 'number', 'min' => 1]) !!}
                </div>
            </div>

            {{ Form::submit(__('user.add_child'), ['class' => 'btn btn-success btn-sm']) }}
            {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-default btn-sm']) }}
            {{ Form::close() }}
        </li>
        @endif
        @endcan
    </ul>
</div>
