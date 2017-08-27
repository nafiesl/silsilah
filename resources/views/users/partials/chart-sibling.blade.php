<div class="panel panel-default table-responsive">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th style="width: 35%">{{ trans('user.siblings') }}</th>
                <th class="text-center" colspan="{{ $sibling->childs->count() }}">{{ $sibling->profileLink('chart') }} ({{ $sibling->gender }})</th>
            </tr>
            <tr>
                <th>{{ trans('user.nieces') }} & {{ trans('user.grand_childs') }}</th>
                <td>
                    <ol style="padding-left: 15px">
                        @foreach($sibling->childs as $child)
                        <li style="margin-top: 10px;">
                            {{ $child->profileLink('chart') }} ({{ $child->gender }})
                            <ul style="padding-left: 18px">
                                @foreach($child->childs as $grand)
                                <li>{{ $grand->profileLink('chart') }} ({{ $grand->gender }})</li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>
</div>