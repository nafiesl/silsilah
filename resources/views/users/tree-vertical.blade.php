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

<div class="tree" style="display: flex; justify-content: center;">
    <ul>
        <li>
            {{ link_to_route('users.tree-vertical', $user->name, [$user->id], ['title' => $user->name.' ('.$user->gender.')']) }}
            @if ($childsCount = $user->childs->count())
            <?php $childsTotal += $childsCount ?>
                <ul>
                    @foreach($user->childs as $child)
                        <li>
                            {{ link_to_route('users.tree-vertical', $child->name, [$child->id], ['title' => $child->name.' ('.$child->gender.')']) }}
                            @if ($grandsCount = $child->childs->count())
                                <?php $grandChildsTotal += $grandsCount ?>
                                <ul>
                                    @foreach($child->childs as $grand)
                                        <li>
                                            {{ link_to_route('users.tree-vertical', $grand->name, [$grand->id], ['title' => $grand->name.' ('.$grand->gender.')']) }}
                                            @if ($ggCount = $grand->childs->count())
                                                <?php $ggTotal += $ggCount ?>
                                                <ul>
                                                    @foreach($grand->childs as $gg)
                                                        <li>
                                                            {{ link_to_route('users.tree-vertical', $gg->name, [$gg->id], ['title' => $gg->name.' ('.$gg->gender.')']) }}
                                                            @if ($ggcCount = $gg->childs->count())
                                                                <?php $ggcTotal += $ggcCount ?>
                                                                <ul>
                                                                    @foreach($gg->childs as $ggc)
                                                                        <li>
                                                                            {{ link_to_route('users.tree-vertical', $ggc->name, [$ggc->id], ['title' => $ggc->name.' ('.$ggc->gender.')']) }}
                                                                            @if ($ggccCount = $ggc->childs->count())
                                                                                <?php $ggccTotal += $ggccCount ?>
                                                                                <ul>
                                                                                    @foreach($ggc->childs as $ggcc)
                                                                                        <li>
                                                                                            {{ link_to_route('users.tree-vertical', $ggcc->name, [$ggcc->id], ['title' => $ggcc->name.' ('.$ggcc->gender.')']) }}
                                                                                            @if ($udhegCount = $ggcc->childs->count())
                                                                                                <?php $udhegTotal += $udhegCount ?>
                                                                                                <ul>
                                                                                                    @foreach($ggcc->childs as $udheg)
                                                                                                        <li>
                                                                                                            {{ link_to_route('users.tree-vertical', $udheg->name, [$udheg->id], ['title' => $udheg->name.' ('.$udheg->gender.')']) }}
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            @endif
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    </ul>
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
</div>
@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/tree-vertical.css') }}">
@endsection
