@extends('layouts.app')

@section('content')
<h3 class="page-header">
    Cari Keluarga Anda
    @if (request('q'))
    <small class="pull-right">User ditemukan : <strong>{{ $users->total() }} Orang</strong> untuk kata kunci : <strong>{{ request('q') }}</strong></small>
    @endif
</h3>


{{ Form::open(['method' => 'get','class' => '']) }}
<div class="input-group">
    {{ Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => 'Masukkan nama/panggilan... klik Cari']) }}
    <span class="input-group-btn">
        {{ Form::submit('Cari', ['class' => 'btn btn-default']) }}
        {{ link_to_route('users.search', 'Reset', [], ['class' => 'btn btn-default']) }}
    </span>
</div>
{{ Form::close() }}

@if (request('q'))
<br>
{!! str_replace('/?', '?', $users->appends(Request::except('page'))->render()) !!}
@foreach ($users->chunk(4) as $chunkedUser)
<div class="row">
    @foreach ($chunkedUser as $user)
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ $user->profileLink() }} ({{ $user->gender }})</h3></div>
            <div class="panel-body">
                <div>Panggilan : {{ $user->nickname }}</div>
                <hr style="margin: 5px 0;">
                <div>Ayah : {{ $user->father_id ? $user->father->name : '' }}</div>
                <div>Ibu : {{ $user->mother_id ? $user->mother->name : '' }}</div>
            </div>
            <div class="panel-footer">
                {{ link_to_route('users.show', 'Lihat Profil', [$user->id], ['class' => 'btn btn-default btn-xs']) }}
                {{ link_to_route('users.chart', 'Bagan Keluarga', [$user->id], ['class' => 'btn btn-default btn-xs']) }}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach

{!! str_replace('/?', '?', $users->appends(Request::except('page'))->render()) !!}
@endif
@endsection
