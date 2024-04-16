<div class="pull-right btn-group" role="group">
    {{ link_to_route('users.tree-horizontal', trans('app.horizontal'), [$user->id], ['class' => Request::segment(3) == 'tree' && Request::segment(4) == 'horizontal' ? 'btn btn-default active' : 'btn btn-default']) }}
    {{ link_to_route('users.tree-vertical', trans('app.vertical'), [$user->id], ['class' => Request::segment(3) == 'tree' && Request::segment(4) == 'vertical' ? 'btn btn-default active' : 'btn btn-default']) }}
</div>
