@extends('layouts.user-profile-wide')

@section('subtitle', trans('app.family_tree'))

@section('user-content')

<?php
$childsTotal = 0;
$grandChildsTotal = 0;
$ggTotal = 0;
$ggcTotal = 0;
$ggccTotal = 0;
?>

<div id="wrapper">
    {!! createFamilyTree($user) !!}
</div>

<div class="container">
    <hr>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        {!! showFamilyTreeCount($user, 4) !!}
        <div class="col-md-1">&nbsp;</div>
    </div>
</div>

@endsection

@section ('ext_css')
    <link rel="stylesheet" href="{{ asset('css/tree.css') }}">
@endsection

