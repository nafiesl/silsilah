@extends('layouts.app')

@section('content')
    <h2 class="page-header">
        <div class="pull-right">
            {{ link_to_route('users.show', 'Lihat Profil '.$user->name, [$user->id], ['class' => 'btn btn-default']) }}
        </div>
        Edit Profil {{ $user->profileLink() }}
    </h2>
    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' =>'patch']) }}
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Profil</h3></div>
                <div class="panel-body">
                    {!! FormField::text('name', ['label' => 'Nama']) !!}
                    {!! FormField::text('nickname', ['label' => 'Nama Panggilan']) !!}
                    <div class="row">
                        <div class="col-md-6">{!! FormField::radios('gender_id', [1 => 'L', 'P'], ['label' => 'Jenis Kelamin']) !!}</div>
                        <div class="col-md-6">{!! FormField::text('dob', ['label' => 'Tanggal Lahir', 'placeholder' => 'Misal: 1959-07-20']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">{!! FormField::text('yod', ['label' => 'Tahun Meninggal', 'placeholder' => 'Misal: 2003']) !!}</div>
                        <div class="col-md-6">{!! FormField::text('dod', ['label' => 'Tanggal Meninggal', 'placeholder' => 'Misal: 2003-10-17']) !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Alamat dan Kontak</h3></div>
                <div class="panel-body">
                    {!! FormField::textarea('address', ['label' => 'Alamat']) !!}
                    {!! FormField::text('city', ['label' => 'Kota']) !!}
                    {!! FormField::text('phone', ['label' => 'Telp', 'placeholder' => 'Misal: 081234567890']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Akun Login</h3></div>
                <div class="panel-body">
                    {!! FormField::email('email', ['label' => 'Email', 'placeholder' => 'Misal: nama@mail.com']) !!}
                    {!! FormField::password('password', ['label' => 'Password', 'placeholder' => '******']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        {{ link_to_route('users.show', 'Cancel', [$user->id], ['class' => 'btn btn-default']) }}
    </div>
    {{ Form::close() }}
@endsection
