<!-- Nav tabs -->
<ul class="nav nav-pills nav-stacked">
    <li class="{{ request('tab') == null ? 'active' : '' }}">
        {!! link_to_route('users.edit', __('user.edit'), [$user->id]) !!}
    </li>
    <li class="{{ request('tab') == 'contact_address' ? 'active' : '' }}">
        {!! link_to_route('users.edit', __('app.address').' &amp; '.__('app.contact'), [$user->id, 'tab' => 'contact_address']) !!}
    </li>
    <li class="{{ request('tab') == 'login_account' ? 'active' : '' }}">
        {!! link_to_route('users.edit', __('app.login_account'), [$user->id, 'tab' => 'login_account']) !!}
    </li>
    <li class="{{ request('tab') == 'death' ? 'active' : '' }}">
        {!! link_to_route('users.edit', __('user.death'), [$user->id, 'tab' => 'death']) !!}
    </li>
</ul>
<br>
@can('delete', $user)
{{ link_to_route('users.edit', __('user.delete'), [$user, 'action' => 'delete'], ['class' => 'btn btn-danger', 'id' => 'del-user-'.$user->id]) }}
@endcan
