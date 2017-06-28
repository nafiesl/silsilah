@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="page-header text-center">{{ $currentUser->profileLink() }}</h3>
    <div class="row">
        <div class="col-md-6">
            @include('users.partials.profile', ['user' => $currentUser])
        </div>
        <div class="col-md-6">
            @include('users.partials.parent-spouse', ['user' => $currentUser])
            @include('users.partials.childs', ['user' => $currentUser])
        </div>
    </div>
</div>
@endsection
