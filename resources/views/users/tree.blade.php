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
    <ul class="branch-0">
        <li>
            {{ $user->profileLink() }}
            <ul class="branch-1">
                @foreach($user->childs as $child)
                <li>
                    {{ $child->profileLink() }}
                    <ul class="branch-2">
                        @foreach($child->childs as $grand)
                        <li>
                            {{ $grand->profileLink() }}
                            <ul class="branch-2">
                                @foreach($grand->childs as $gg)
                                <li>
                                    {{ $gg->profileLink() }}
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/tree.css') }}">
@endsection
