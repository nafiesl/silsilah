<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ __('user.family') }}</h3></div>

    <table class="table">
        <tbody>
            <tr>
                <th class="col-sm-4">{{ __('user.father') }}</th>
                <td class="col-sm-8">
                    @can ('edit', $user)
                        @if (request('action') == 'set_father')
                        {{ Form::open(['route' => ['family-actions.set-father', $user->id]]) }}
                        {!! FormField::select('set_father_id', $malePersonList, ['label' => false, 'value' => $user->father_id, 'placeholder' => __('app.select_from_existing_males')]) !!}
                        <div class="input-group">
                            {{ Form::text('set_father', null, ['class' => 'form-control input-sm', 'placeholder' => __('app.enter_new_name')]) }}
                            <span class="input-group-btn">
                                {{ Form::submit(__('app.update'), ['class' => 'btn btn-info btn-sm', 'id' => 'set_father_button']) }}
                                {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-default btn-sm']) }}
                            </span>
                        </div>
                        {{ Form::close() }}
                        @else
                            {{ $user->fatherLink() }}
                            <div class="pull-right">
                                {{ link_to_route('users.show', __('user.set_father'), [$user->id, 'action' => 'set_father'], ['class' => 'btn btn-link btn-xs']) }}
                            </div>
                        @endif
                    @else
                        {{ $user->fatherLink() }}
                    @endcan
                </td>
            </tr>
            <tr>
                <th>{{ __('user.mother') }}</th>
                <td>
                    @can ('edit', $user)
                        @if (request('action') == 'set_mother')
                        {{ Form::open(['route' => ['family-actions.set-mother', $user->id]]) }}
                        {!! FormField::select('set_mother_id', $femalePersonList, ['label' => false, 'value' => $user->mother_id, 'placeholder' => __('app.select_from_existing_females')]) !!}
                        <div class="input-group">
                            {{ Form::text('set_mother', null, ['class' => 'form-control input-sm', 'placeholder' => __('app.enter_new_name')]) }}
                            <span class="input-group-btn">
                                {{ Form::submit(__('app.update'), ['class' => 'btn btn-info btn-sm', 'id' => 'set_mother_button']) }}
                                {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-default btn-sm']) }}
                            </span>
                        </div>
                        {{ Form::close() }}
                        @else
                            {{ $user->motherLink() }}
                            <div class="pull-right">
                                {{ link_to_route('users.show', __('user.set_mother'), [$user->id, 'action' => 'set_mother'], ['class' => 'btn btn-link btn-xs']) }}
                            </div>
                        @endif
                    @else
                        {{ $user->motherLink() }}
                    @endcan
                </td>
            </tr>
            <tr>
                <th class="col-sm-4">{{ __('user.parent') }}</th>
                <td class="col-sm-8">
                    @can ('edit', $user)
                    <div class="pull-right">
                        @unless (request('action') == 'set_parent')
                            {{ link_to_route('users.show', __('user.set_parent'), [$user->id, 'action' => 'set_parent'], ['class' => 'btn btn-link btn-xs']) }}
                        @endunless
                    </div>
                    @endcan

                    @if ($user->parent)
                    {{ $user->parent->husband->name }} & {{ $user->parent->wife->name }}
                    @endif

                    @can('edit', $user)
                        @if (request('action') == 'set_parent')
                            {{ Form::open(['route' => ['family-actions.set-parent', $user->id]]) }}
                            {!! FormField::select('set_parent_id', $allMariageList, ['label' => false, 'value' => $user->parent_id, 'placeholder' => __('app.select_from_existing_couples')]) !!}
                            {{ Form::submit(__('app.update'), ['class' => 'btn btn-info btn-sm', 'id' => 'set_parent_button']) }}
                            {{ link_to_route('users.show', __('app.cancel'), $user, ['class' => 'btn btn-default btn-sm']) }}
                            {{ Form::close() }}
                        @endif
                    @endcan
                </td>
            </tr>
            @if ($user->gender_id == 1)
            <tr>
                <th>{{ __('user.wife') }}</th>
                <td>
                    @can ('edit', $user)
                    <div class="pull-right">
                        @unless (request('action') == 'add_spouse')
                            {{ link_to_route('users.show', __('user.add_wife'), [$user->id, 'action' => 'add_spouse'], ['class' => 'btn btn-link btn-xs']) }}
                        @endunless
                    </div>
                    @endcan

                    @if ($user->wifes->isEmpty() == false)
                        <ul class="list-unstyled">
                            @foreach($user->wifes as $wife)
                            <li>{{ $wife->profileLink() }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @can('edit', $user)
                        @if (request('action') == 'add_spouse')
                        <div>
                            {{ Form::open(['route' => ['family-actions.add-wife', $user->id]]) }}
                            {!! FormField::select('set_wife_id', $femalePersonList, ['label' => false, 'placeholder' => __('app.select_from_existing_females')]) !!}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        {{ Form::text('set_wife', null, ['class' => 'form-control input-sm', 'placeholder' => __('app.enter_new_name')]) }}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::text('marriage_date', null, ['class' => 'form-control input-sm', 'placeholder' => __('couple.marriage_date')]) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::submit(__('app.update'), ['class' => 'btn btn-info btn-sm', 'id' => 'set_wife_button']) }}
                            {{ link_to_route('users.show', __('app.cancel'), $user, ['class' => 'btn btn-default btn-sm']) }}
                            {{ Form::close() }}
                        </div>
                        @endif
                    @endcan
                </td>
            </tr>
            @else
            <tr>
                <th>{{ __('user.husband') }}</th>
                <td>
                    @can ('edit', $user)
                    <div class="pull-right">
                        @unless (request('action') == 'add_spouse')
                            {{ link_to_route('users.show', __('user.add_husband'), [$user->id, 'action' => 'add_spouse'], ['class' => 'btn btn-link btn-xs']) }}
                        @endunless
                    </div>
                    @endcan
                    @if ($user->husbands->isEmpty() == false)
                        <ul class="list-unstyled">
                            @foreach($user->husbands as $husband)
                            <li>{{ $husband->profileLink() }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @can('edit', $user)
                        @if (request('action') == 'add_spouse')
                        <div>
                            {{ Form::open(['route' => ['family-actions.add-husband', $user->id]]) }}
                            {!! FormField::select('set_husband_id', $malePersonList, ['label' => false, 'placeholder' => __('app.select_from_existing_males')]) !!}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        {{ Form::text('set_husband', null, ['class' => 'form-control input-sm', 'placeholder' => __('app.enter_new_name')]) }}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::text('marriage_date', null, ['class' => 'form-control input-sm', 'placeholder' => __('couple.marriage_date')]) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::submit(__('app.update'), ['class' => 'btn btn-info btn-sm', 'id' => 'set_husband_button']) }}
                            {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-default btn-sm']) }}
                            {{ Form::close() }}
                        </div>
                        @endif
                    @endcan
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
