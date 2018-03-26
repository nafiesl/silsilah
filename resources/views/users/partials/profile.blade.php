<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ trans('user.profile') }}</h3></div>
    <div class="panel-body text-center">
        @if ($user->photo_path && is_file(public_path('storage/'.$user->photo_path)))
            {{ Html::image('storage/'.$user->photo_path, $user->name, ['style' => 'max-width:100%']) }}
        @else
            {{ Html::image('images/icon_user_'.$user->gender_id.'.png', $user->name, ['style' => 'max-width:100%']) }}
        @endif
    </div>
    <table class="table">
        <tbody>
            <tr>
                <th class="col-sm-4">{{ trans('user.name') }}</th>
                <td class="col-sm-8">
                    {{ $user->profileLink() }}
                </td>
            </tr>
            <tr>
                <th>{{ trans('user.nickname') }}</th>
                <td>{{ $user->nickname }}</td>
            </tr>
            <tr>
                <th>{{ trans('user.gender') }}</th>
                <td>{{ $user->gender }}</td>
            </tr>
            <tr>
                <th>{{ trans('user.dob') }}</th>
                <td>{{ $user->dob }}</td>
            </tr>
            @if ($user->dod)
            <tr>
                <th>{{ trans('user.dod') }}</th>
                <td>{{ $user->dod }}</td>
            </tr>
            @endif
            @if ($user->email)
            <tr>
                <th>{{ trans('user.email') }}</th>
                <td>{{ $user->email }}</td>
            </tr>
            @endif
            <tr>
                <th>{{ trans('user.phone') }}</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th>{{ trans('user.address') }}</th>
                <td>{!! nl2br($user->address) !!}</td>
            </tr>
        </tbody>
    </table>
</div>
