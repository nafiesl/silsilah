@extends('layouts.family-tree')

@section('family-tree-content')
<?php
$childsTotal = 0;
$grandChildsTotal = 0;
$ggTotal = 0;
$ggcTotal = 0;
$ggccTotal = 0;
$udhegTotal = 0;
?>

<div id="wrapper">
    <span class="label">{{ link_to_route('users.tree-horizontal', $user->name, [$user->id], ['title' => $user->name.' ('.$user->gender.')']) }}</span>
    @if ($childsCount = $user->childs->count())
    <?php $childsTotal += $childsCount ?>
    <div class="branch lv1">
        @foreach($user->childs as $child)
        <div class="entry {{ $childsCount == 1 ? 'sole' : '' }}">
            <span class="label">{{ link_to_route('users.tree-horizontal', $child->name, [$child->id], ['title' => $child->name.' ('.$child->gender.')']) }}</span>
            @if ($grandsCount = $child->childs->count())
            <?php $grandChildsTotal += $grandsCount ?>
            <div class="branch lv2">
                @foreach($child->childs as $grand)
                <div class="entry {{ $grandsCount == 1 ? 'sole' : '' }}">
                    <span class="label">{{ link_to_route('users.tree-horizontal', $grand->name, [$grand->id], ['title' => $grand->name.' ('.$grand->gender.')']) }}</span>
                    @if ($ggCount = $grand->childs->count())
                    <?php $ggTotal += $ggCount ?>
                    <div class="branch lv3">
                        @foreach($grand->childs as $gg)
                        <div class="entry {{ $ggCount == 1 ? 'sole' : '' }}">
                            <span class="label">{{ link_to_route('users.tree-horizontal', $gg->name, [$gg->id], ['title' => $gg->name.' ('.$gg->gender.')']) }}</span>
                            @if ($ggcCount = $gg->childs->count())
                            <?php $ggcTotal += $ggcCount ?>
                            <div class="branch lv4">
                                @foreach($gg->childs as $ggc)
                                <div class="entry {{ $ggcCount == 1 ? 'sole' : '' }}">
                                    <span class="label">{{ link_to_route('users.tree-horizontal', $ggc->name, [$ggc->id], ['title' => $ggc->name.' ('.$ggc->gender.')']) }}</span>
                                    @if ($ggccCount = $ggc->childs->count())
                                    <?php $ggccTotal += $ggccCount ?>
                                    <div class="branch lv5">
                                        @foreach($ggc->childs as $ggcc)
                                        <div class="entry {{ $ggccCount == 1 ? 'sole' : '' }}">
                                            <span class="label">{{ link_to_route('users.tree-horizontal', $ggcc->name, [$ggcc->id], ['title' => $ggcc->name.' ('.$ggcc->gender.')']) }}</span>
                                            @if ($udhegCount = $ggcc->childs->count())
                                            <?php $udhegTotal += $udhegCount ?>
                                            <div class="branch lv6">
                                                @foreach($ggcc->childs as $udheg)
                                                <div class="entry {{ $udhegCount == 1 ? 'sole' : '' }}">
                                                    <span class="label">{{ link_to_route('users.tree-horizontal', $udheg->name, [$udheg->id], ['title' => $udheg->name.' ('.$udheg->gender.')']) }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
<div class="container">
<hr>
<div class="row">
    @if ($childsTotal)
    <div class="col-md-1 text-right">{{ trans('app.child_count') }}</div>
    <div class="col-md-1 text-left"><strong style="font-size:30px">{{ $childsTotal }}</strong></div>
    @endif
    @if ($grandChildsTotal)
    <div class="col-md-1 text-right">{{ trans('app.grand_child_count') }}</div>
    <div class="col-md-1 text-left"><strong style="font-size:30px">{{ $grandChildsTotal }}</strong></div>
    @endif
    @if ($ggTotal)
    <div class="col-md-1 text-right">Jumlah Cicit</div>
    <div class="col-md-1 text-left"><strong style="font-size:30px">{{ $ggTotal }}</strong></div>
    @endif
    @if ($ggcTotal)
    <div class="col-md-1 text-right">Jumlah Canggah</div>
    <div class="col-md-1 text-left"><strong style="font-size:30px">{{ $ggcTotal }}</strong></div>
    @endif
    @if ($ggccTotal)
    <div class="col-md-1 text-right">Jumlah Wareng</div>
    <div class="col-md-1 text-left"><strong style="font-size:30px">{{ $ggccTotal }}</strong></div>
    @endif
    @if ($udhegTotal)
    <div class="col-md-1 text-right">Jumlah Udheg2</div>
    <div class="col-md-1 text-left"><strong style="font-size:30px">{{ $udhegTotal }}</strong></div>
    @endif
</div>
@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/tree-horizontal.css') }}">
@endsection
