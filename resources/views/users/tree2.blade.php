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

<div class="tree">
    <ul>
        <li>
            {{ link_to_route('users.tree', $user->name, [$user->id], ['title' => $user->name.' ('.$user->gender.')']) }}
            @if ($user->childs->count())
            <ul>
                @foreach($user->childs as $child)
                <li>
                    {{ link_to_route('users.tree', $child->id, [$child->id], ['title' => $child->name.' ('.$child->gender.')']) }}
                    @if ($child->childs->count())
                    <ul>
                        @foreach($child->childs as $grand)
                        <li>
                            {{ link_to_route('users.tree', $grand->id, [$grand->id], ['title' => $grand->name.' ('.$grand->gender.')']) }}
                            @if ($grand->childs->count())
                            <ul>
                                @foreach($grand->childs as $gg)
                                <li>
                                    {{ link_to_route('users.tree', $gg->id, [$gg->id], ['title' => $gg->name.' ('.$gg->gender.')']) }}
                                    <?php /*
                                    @if ($gg->childs->count())
                                    <ul>
                                        @foreach($gg->childs as $ggc)
                                        <li>
                                            {{ link_to_route('users.tree', $ggc->id, [$ggc->id], ['title' => $ggc->name.' ('.$ggc->gender.')']) }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    */ ?>
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
    <div class="clearfix"></div>
</div>
@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/tree2.css') }}">
@endsection
