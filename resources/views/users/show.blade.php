@extends('layouts.app')

@section('content')
    <div class="pull-right">
        {{ link_to_route('users.edit', 'Edit Data '.$currentUser->name, [$currentUser->id], ['class' => 'btn btn-warning']) }}
        {{ link_to_route('users.chart', 'Lihat Chart Keluarga '.$currentUser->name, [$currentUser->id], ['class' => 'btn btn-default']) }}
    </div>
    <h3 class="page-header text-center">{{ $currentUser->profileLink() }}</h3>
    <div class="row">
        <div class="col-md-6">
            @include('users.partials.profile', ['user' => $currentUser])
            @include('users.partials.siblings', ['user' => $currentUser])
        </div>
        <div class="col-md-6">
            @include('users.partials.parent-spouse', ['user' => $currentUser])
            @include('users.partials.childs', ['user' => $currentUser])
        </div>
    </div>
@endsection
