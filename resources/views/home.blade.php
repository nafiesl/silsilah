@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Profile : {{ $currentUser->name ?: $currentUser->nickname }}</div>

                <div class="panel-body">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <th class="col-sm-4">Nama Panggilan</th>
                                <td class="col-sm-6">{{ $currentUser->nickname }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $currentUser->profileLink() }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $currentUser->gender }}</td>
                            </tr>
                            <tr>
                                <th>Ayah</th>
                                <td>
                                    @if ($currentUser->father_id)
                                        {{ $currentUser->father->profileLink() }}
                                    @else
                                        {{ Form::open(['route' => ['family-actions.set-father', $currentUser->id]]) }}
                                        {!! FormField::select('set_father_id', $malePersonList, ['label' => false]) !!}
                                        <div class="input-group">
                                            {{ Form::text('set_father', null, ['class' => 'form-control input-sm']) }}
                                            <span class="input-group-btn">
                                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_father_button']) }}
                                            </span>
                                        </div>
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Ibu</th>
                                <td>
                                    @if ($currentUser->mother_id)
                                        {{ $currentUser->mother->profileLink() }}
                                    @else
                                        {{ Form::open(['route' => ['family-actions.set-mother', $currentUser->id]]) }}
                                        {!! FormField::select('set_mother_id', $femalePersonList, ['label' => false]) !!}
                                        <div class="input-group">
                                            {{ Form::text('set_mother', null, ['class' => 'form-control input-sm']) }}
                                            <span class="input-group-btn">
                                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_mother_button']) }}
                                            </span>
                                        </div>
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Keluarga</div>

                <div class="panel-body">
                    <table class="table table-condensed">
                        <tbody>
                            @if ($currentUser->gender_id == 1)
                            <tr>
                                <th>Isteri</th>
                                <td>
                                    @if ($currentUser->wifes->isEmpty() == false)
                                        <ul>
                                            @foreach($currentUser->wifes as $wife)
                                            <li>{{ $wife->profileLink() }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ Form::open(['route' => ['family-actions.add-wife', $currentUser->id]]) }}
                                        <div class="input-group">
                                            {{ Form::text('set_wife', null, ['class' => 'form-control input-sm']) }}
                                            <span class="input-group-btn">
                                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_wife_button']) }}
                                            </span>
                                        </div>
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                            @else
                            <tr>
                                <th>Suami</th>
                                <td>
                                    @if ($currentUser->husbands->isEmpty() == false)
                                        <ul>
                                            @foreach($currentUser->husbands as $husband)
                                            <li>{{ $husband->profileLink() }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ Form::open(['route' => ['family-actions.add-husband', $currentUser->id]]) }}
                                        <div class="input-group">
                                            {{ Form::text('set_husband', null, ['class' => 'form-control input-sm']) }}
                                            <span class="input-group-btn">
                                                {{ Form::submit('update', ['class' => 'btn btn-info btn-sm', 'id' => 'set_husband_button']) }}
                                            </span>
                                        </div>
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <legend>Anak-Anak</legend>
                    <ul class="list-group">
                        @foreach($currentUser->childs as $child)
                            <li class="list-group-item">
                                {{ $child->profileLink() }} ({{ $child->gender }})
                            </li>
                        @endforeach
                        <li class="list-group-item">
                            {{ Form::open(['route' => ['family-actions.add-child', $currentUser->id]]) }}
                            <div class="row">
                                <div class="col-md-4">
                                    {!! FormField::text('add_child_name', ['label' => 'Nama Anak']) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! FormField::radios('add_child_gender_id', [1 => 'Laki-laki', 2 => 'Perempuan'], ['label' => 'Jenis Kelamin Anak']) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! FormField::select('add_child_parent_id', $usersMariageList, ['label' => 'Dari Pernikahan']) !!}
                                </div>
                            </div>
                            {{ Form::submit('Tambah Anak', ['class' => 'btn btn-success btn-sm']) }}
                            {{ Form::close() }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
