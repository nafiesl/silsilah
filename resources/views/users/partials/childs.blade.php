<div class="panel panel-default">
    <div class="panel-heading">
        @can ('edit', $currentUser)
        <div class="pull-right" style="margin: -3px -6px">
            {{ link_to_route('users.show', 'Tambah Anak', [$user->id, 'action' => 'add_child'], ['class' => 'btn btn-success btn-xs']) }}
        </div>
        @endcan
        <h3 class="panel-title">Anak-Anak ({{ $user->childs->count() }})</h3>
    </div>

    <ul class="list-group">
        @foreach($user->childs as $child)
            <li class="list-group-item">
                {{ $child->profileLink() }} ({{ $child->gender }})
            </li>
        @endforeach
        @can('edit', $currentUser)
        @if (request('action') == 'add_child')
        <li class="list-group-item">
            {{ Form::open(['route' => ['family-actions.add-child', $user->id]]) }}
            <div class="row">
                <div class="col-md-4">
                    {!! FormField::text('add_child_name', ['label' => 'Nama Anak']) !!}
                </div>
                <div class="col-md-4">
                    {!! FormField::radios('add_child_gender_id', [1 => 'Laki-laki', 2 => 'Perempuan'], ['label' => 'Jenis Kelamin Anak']) !!}
                </div>
                <div class="col-md-4">
                    {!! FormField::select('add_child_parent_id', $usersMariageList, ['label' => 'Dari Pernikahan']) !!}
                </div>
            </div>
            {{ Form::submit('Tambah Anak', ['class' => 'btn btn-success btn-sm']) }}
            {{ link_to_route('users.show', 'Batal', [$user->id], ['class' => 'btn btn-default btn-sm']) }}
            {{ Form::close() }}
        </li>
        @endif
        @endcan
    </ul>
</div>