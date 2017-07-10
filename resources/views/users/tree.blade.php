@extends('layouts.app')

@section('content')
</div>
<div class="container-fluid">
<h1 class="page-header">
    <div class="pull-right">
        {{ link_to_route('users.show', 'Lihat Profil '.$user->name, [$user->id], ['class' => 'btn btn-default']) }}
    </div>
    {{ $user->name }} <small>Pohon Keluarga</small>
</h1>

<div id="wrapper">
    <span class="label">{{ link_to_route('users.tree', $user->name, [$user->id], ['title' => $user->name.' ('.$user->gender.')']) }}</span>
        @if ($childsCount = $user->childs->count())
        <div class="branch lv1">
            @foreach($user->childs as $child)
            <div class="entry {{ $childsCount == 1 ? 'sole' : '' }}">
                <span class="label">{{ link_to_route('users.tree', $child->name, [$child->id], ['title' => $child->name.' ('.$child->gender.')']) }}</span>
                @if ($grandsCount = $child->childs->count())
                <div class="branch lv2">
                    @foreach($child->childs as $grand)
                    <div class="entry {{ $grandsCount == 1 ? 'sole' : '' }}">
                        <span class="label">{{ link_to_route('users.tree', $grand->name, [$grand->id], ['title' => $grand->name.' ('.$grand->gender.')']) }}</span>
                        @if ($ggCount = $grand->childs->count())
                        <div class="branch lv3">
                            @foreach($grand->childs as $gg)
                            <div class="entry {{ $ggCount == 1 ? 'sole' : '' }}">
                                <span class="label">{{ link_to_route('users.tree', $gg->name, [$gg->id], ['title' => $gg->name.' ('.$gg->gender.')']) }}</span>
                                @if ($ggcCount = $gg->childs->count())
                                <div class="branch lv4">
                                    @foreach($gg->childs as $ggc)
                                    <div class="entry {{ $ggcCount == 1 ? 'sole' : '' }}">
                                        <span class="label">{{ link_to_route('users.tree', $ggc->name, [$ggc->id], ['title' => $ggc->name.' ('.$ggc->gender.')']) }}</span>
                                        @if ($ggccCount = $ggc->childs->count())
                                        <div class="branch lv5">
                                            @foreach($ggc->childs as $ggcc)
                                            <div class="entry {{ $ggccCount == 1 ? 'sole' : '' }}">
                                                <span class="label">{{ link_to_route('users.tree', $ggcc->name, [$ggcc->id], ['title' => $ggcc->name.' ('.$ggcc->gender.')']) }}</span>
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
</div>
@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/tree.css') }}">
@endsection
