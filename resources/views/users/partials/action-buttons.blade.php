<div class="pull-right btn-group" role="group">
    @can ('edit', $user)
    {{ link_to_route('users.edit', trans('app.edit'), [$user->id], ['class' => 'btn btn-warning']) }}
    @endcan
    {{ link_to_route('users.show', trans('app.show_profile').' '.$user->name, [$user->id], ['class' => Request::segment(3) == null ? 'btn btn-default active' : 'btn btn-default']) }}
    {{ link_to_route('users.chart', trans('app.show_family_chart'), [$user->id], ['class' => Request::segment(3) == 'chart' ? 'btn btn-default active' : 'btn btn-default']) }}
    {{ link_to_route('users.tree', trans('app.show_family_tree'), [$user->id], ['class' => Request::segment(3) == 'tree' ? 'btn btn-default active' : 'btn btn-default']) }}
    {{ link_to_route('users.marriages', trans('app.show_marriages'), [$user->id], ['class' => Request::segment(3) == 'marriages' ? 'btn btn-default active' : 'btn btn-default']) }}
    @auth
        @if (auth()->user()->hasFamilyConnectionRequestTo($user))
            {!! FormField::delete(['route' => ['users.family_connection_requests.destroy', $user->id]], __('family_connection.cancel_request'), ['class' => 'btn btn-warning', 'id' => 'cancel_family_connection_request']) !!}
        @else
            {!! FormField::formButton(['route' => ['users.family_connection_requests.store', $user->id]], __('family_connection.send_request'), ['class' => 'btn btn-success', 'id' => 'send_family_connection_request']) !!}
        @endif

        @if (auth()->user()->hasPendingFamilyConnectionRequestFrom($user))
            {!! FormField::formButton(['route' => ['users.family_connection_requests.update', $user->id], 'method' => 'patch'], __('family_connection.accept_request'), ['class' => 'btn btn-success', 'id' => 'accept_family_connection_request']) !!}
            {!! FormField::delete(['route' => ['users.family_connection_requests.destroy', $user->id]], __('family_connection.reject_request'), ['class' => 'btn btn-danger', 'id' => 'reject_family_connection_request']) !!}
        @endif
    @endauth
</div>
