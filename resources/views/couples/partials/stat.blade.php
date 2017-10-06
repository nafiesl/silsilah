<div class="panel panel-default table-responsive hidden-xs">
    <table class="table table-condensed table-bordered">
        <tr>
            <td class="col-xs-2 text-center">{{ trans('couple.husband') }}</td>
            <td class="col-xs-2 text-center">{{ trans('couple.wife') }}</td>
            <td class="col-xs-2 text-center">{{ trans('couple.childs_count') }}</td>
            <td class="col-xs-2 text-center">{{ trans('couple.marriage_date') }}</td>
        </tr>
        <tr>
            <td class="text-center lead" style="border-top: none;">{{ $couple->husband->profileLink() }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->wife->profileLink() }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->childs->count() }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->marriage_date }}</td>
        </tr>
    </table>
</div>

<ul class="list-group visible-xs">
    <li class="list-group-item">
        {{ trans('couple.husband') }}
        <span class="pull-right">{{ $couple->husband->profileLink() }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('couple.wife') }}
        <span class="pull-right">{{ $couple->wife->profileLink() }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('couple.childs_count') }}
        <span class="pull-right">{{ $couple->childs->count() }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('couple.marriage_date') }}
        <span class="pull-right">{{ $couple->marriage_date }}</span>
    </li>
</ul>