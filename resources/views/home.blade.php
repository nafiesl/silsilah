@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
                                        {{ Form::open(['route' => ['family-actions.set-father', $currentUser->id, $currentUser->id]]) }}
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
                            <tr>
                                <th colspan="2">Anak-Anak</th>
                            </tr>
                            <tr>
                                <td colspan="2">
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
                                                <div class="col-md-5">
                                                    {!! FormField::radios('add_child_gender_id', [1 => 'Laki-laki', 2 => 'Perempuan'], ['label' => 'Jenis Kelamin Anak']) !!}
                                                </div>
                                                <div class="col-md-3">
                                                    <br>
                                                    {{ Form::submit('Tambah Anak', ['class' => 'btn btn-success btn-sm']) }}
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
