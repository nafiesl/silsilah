@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        @include('users.partials.action-buttons', ['user' => $currentUser])
        {{ $currentUser->name }} <small>Profil</small>
    </h1>
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

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/plugins/select2.min.css') }}">
@endsection

@section ('ext_js')
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
@endsection

@section ('script')
<script>
(function () {
    $('select').select2();
})();
</script>
@endsection
