@extends('layouts.app')

@section('content')
<h2 class="page-header">
     {{ $couple->husband->name }} &amp; {{ $couple->wife->name }} <small>{{ trans('couple.edit') }}</small>
</h2>

@include('couples.partials.stat')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ trans('couple.update') }}</h3></div>
            {!! Form::model($couple, ['route' => ['couples.update', $couple], 'method' => 'patch']) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! FormField::text('marriage_date', ['label' => trans('couple.marriage_date')]) !!}
                    </div>
                    <div class="col-md-6">
                        {!! FormField::text('divorce_date', ['label' => trans('couple.divorce_date')]) !!}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                {!! Form::submit(trans('couple.update'), ['class' => 'btn btn-success']) !!}
                {{ link_to_route('couples.show', trans('app.cancel'), [$couple], ['class' => 'btn btn-default']) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/plugins/jquery.datetimepicker.css') }}">
@endsection

@section ('ext_js')
<script src="{{ asset('js/plugins/jquery.datetimepicker.js') }}"></script>
@endsection

@section ('script')
<script>
(function () {
    $('#marriage_date, #divorce_date').datetimepicker({
        timepicker:false,
        format:'Y-m-d',
        closeOnDateSelect: true,
        scrollInput: false
    });
})();
</script>
@endsection
