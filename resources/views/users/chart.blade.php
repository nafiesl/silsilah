@extends('layouts.app')

@section('content')
<div class="pull-right">
    {{ link_to_route('users.show', 'Lihat Profil '.$user->name, [$user->id], ['class' => 'btn btn-default']) }}
</div>
<h3 class="page-header text-center">{{ $user->profileLink('chart') }}</h3>
</div>
<div class="container-fluid">
<div class="panel panel-default table-responsive">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th style="width: 10%">Kakek & Nenek</th>
                <td class="text-center" colspan="{{ $colspan }}">
                    <span class="col-xs-3">{{ $fatherGrandpa ? $fatherGrandpa->profileLink('chart') : '?' }}</span>
                    <span class="col-xs-3">{{ $fatherGrandma ? $fatherGrandma->profileLink('chart') : '?' }}</span>
                    <span class="col-xs-3" style="border-left:1px solid #ccc">
                        {{ $motherGrandpa ? $motherGrandpa->profileLink('chart') : '?' }}
                    </span>
                    <span class="col-xs-3">{{ $motherGrandma ? $motherGrandma->profileLink('chart') : '?' }}</span>
                </td>
            </tr>
            <tr>
                <th>Ayah & Ibu</th>
                <td class="text-center" colspan="{{ $colspan }}">
                    <span class="col-xs-6">{{ $father ? $father->profileLink('chart') : '?' }}</span>
                    <span class="col-xs-6" style="border-left:1px solid #ccc">{{ $mother ? $mother->profileLink('chart') : '?' }}</span>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <th class="text-center" colspan="{{ $colspan }}">{{ $user->profileLink('chart') }} ({{ $user->gender }})</th>
            </tr>
            <tr>
                <th>Anak-Anak & Cucu-Cucu</th>
                @foreach($childs as $child)
                <td>
                    {{ $child->profileLink('chart') }} ({{ $child->gender }})
                    <ul style="padding-left: 18px">
                        @foreach($child->childs as $grand)
                        <li>{{ $grand->profileLink('chart') }} ({{ $grand->gender }})</li>
                        @endforeach
                    </ul>
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@foreach ($siblings->chunk(4) as $chunkedSiblings)
<div class="row">
    @foreach ($chunkedSiblings as $sibling)
    <div class="col-sm-3">
        <div class="panel panel-default table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th style="width: 35%">Saudara</th>
                        <th class="text-center" colspan="{{ $sibling->childs->count() }}">{{ $sibling->profileLink('chart') }} ({{ $sibling->gender }})</th>
                    </tr>
                    <tr>
                        <th>Keponakan & Cucu-Cucu</th>
                        <td>
                            <ol style="padding-left: 15px">
                                @foreach($sibling->childs as $child)
                                <li>
                                    {{ $child->profileLink('chart') }} ({{ $child->gender }})
                                    <ul style="padding-left: 18px">
                                        @foreach($child->childs as $grand)
                                        <li>{{ $grand->profileLink('chart') }} ({{ $grand->gender }})</li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
@endforeach
@endsection
