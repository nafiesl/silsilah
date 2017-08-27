<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ trans('user.siblings') }}</h3></div>
    <table class="table">
        <tbody>
            @foreach($user->siblings() as $sibling)
            <tr>
                <td>
                    {{ $sibling->profileLink() }} ({{ $sibling->gender }})
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>