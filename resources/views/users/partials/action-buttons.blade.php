<div class="pull-right btn-group" role="group">
    @can ('edit', $user)
    {{ link_to_route('users.edit', 'Edit Data', [$user->id], ['class' => 'btn btn-warning']) }}
    @endcan
    {{ link_to_route('users.show', 'Lihat Profil '.$user->name, [$user->id], ['class' => Request::segment(3) == null ? 'btn btn-default active' : 'btn btn-default']) }}
    {{ link_to_route('users.chart', 'Lihat Bagan Keluarga', [$user->id], ['class' => Request::segment(3) == 'chart' ? 'btn btn-default active' : 'btn btn-default']) }}
    {{ link_to_route('users.tree', 'Lihat Pohon Keluarga', [$user->id], ['class' => Request::segment(3) == 'tree' ? 'btn btn-default active' : 'btn btn-default']) }}
</div>