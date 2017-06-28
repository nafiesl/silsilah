<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Keluarga</h3></div>

    <table class="table">
        <tbody>
            <tr>
                <th>Ayah</th>
                <td>
                    @if ($user->father_id)
                        {{ $user->father->profileLink() }}
                    @else
                        {{ Form::open(['route' => ['family-actions.set-father', $user->id]]) }}
                        {!! FormField::select('set_father_id', $malePersonList, ['label' => false]) !!}
                        <div class="input-group">
                            {{ Form::text('set_father', null, ['class' => 'form-control input-sm']) }}
                            <span class="input-group-btn">
                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_father_button']) }}
                            </span>
                        </div>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ibu</th>
                <td>
                    @if ($user->mother_id)
                        {{ $user->mother->profileLink() }}
                    @else
                        {{ Form::open(['route' => ['family-actions.set-mother', $user->id]]) }}
                        {!! FormField::select('set_mother_id', $femalePersonList, ['label' => false]) !!}
                        <div class="input-group">
                            {{ Form::text('set_mother', null, ['class' => 'form-control input-sm']) }}
                            <span class="input-group-btn">
                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_mother_button']) }}
                            </span>
                        </div>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
            @if ($user->gender_id == 1)
            <tr>
                <th>Isteri</th>
                <td>
                    @if ($user->wifes->isEmpty() == false)
                        <ul class="list-unstyled">
                            @foreach($user->wifes as $wife)
                            <li>{{ $wife->profileLink() }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ Form::open(['route' => ['family-actions.add-wife', $user->id]]) }}
                        {!! FormField::select('set_wife_id', $femalePersonList, ['label' => false]) !!}
                        <div class="input-group">
                            {{ Form::text('set_wife', null, ['class' => 'form-control input-sm']) }}
                            <span class="input-group-btn">
                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_wife_button']) }}
                            </span>
                        </div>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
            @else
            <tr>
                <th>Suami</th>
                <td>
                    @if ($user->husbands->isEmpty() == false)
                        <ul class="list-unstyled">
                            @foreach($user->husbands as $husband)
                            <li>{{ $husband->profileLink() }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ Form::open(['route' => ['family-actions.add-husband', $user->id]]) }}
                        {!! FormField::select('set_husband_id', $malePersonList, ['label' => false]) !!}
                        <div class="input-group">
                            {{ Form::text('set_husband', null, ['class' => 'form-control input-sm']) }}
                            <span class="input-group-btn">
                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_husband_button']) }}
                            </span>
                        </div>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>