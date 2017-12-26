<div class="panel panel-default">
    <div class="panel-heading">
        @can ('edit', $user)
        <div class="pull-right" style="margin: -3px -6px">
            {{ link_to_route('users.show', trans('user.add_child'), [$user->id, 'action' => 'add_child'], ['class' => 'btn btn-success btn-xs']) }}
        </div>
        @endcan
        <h3 class="panel-title">{{ trans('user.childs') }} ({{ $user->childs->count() }})</h3>
    </div>

    <ul class="list-group">
        @forelse($user->childs as $child)
            <li class="list-group-item">
                {{ $child->profileLink() }} ({{ $child->gender }})
            </li>
        @empty
            <li class="list-group-item"><i>{{ trans('app.childs_were_not_recorded') }}</i></li>
        @endforelse
        @can('edit', $user)
        @if (request('action') == 'add_child')
        <li class="list-group-item">
            {{ Form::open(['route' => ['family-actions.add-child', $user->id]]) }}
            <div class="row">
                <div class="col-md-6">
                    {!! FormField::text('add_child_name', ['label' => trans('user.child_name')]) !!}
                </div>
                <div class="col-md-6">
                    {!! FormField::radios('add_child_gender_id', [1 => trans('app.male'), 2 => trans('app.female')], ['label' => trans('user.child_gender')]) !!}
                </div>
            </div>
            {!! FormField::select('add_child_parent_id', $usersMariageList, ['label' => trans('user.add_child_from_existing_couples', ['name' => $user->name]), 'placeholder' => trans('app.unknown')]) !!}
            {{ Form::submit(trans('user.add_child'), ['class' => 'btn btn-success btn-sm']) }}
            {{ link_to_route('users.show', trans('app.cancel'), [$user->id], ['class' => 'btn btn-default btn-sm']) }}
            {{ Form::close() }}
        </li>
        @endif
        @endcan
    </ul>
</div>