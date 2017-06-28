<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Profil</h3></div>
    <table class="table">
        <tbody>
            <tr>
                <th class="col-sm-4">Nama</th>
                <td class="col-sm-8">
                    {{ $user->profileLink() }}
                </td>
            </tr>
            <tr>
                <th>Nama Panggilan</th>
                <td>{{ $user->nickname }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $user->gender }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $user->dob }}</td>
            </tr>
            @if ($user->dod)
            <tr>
                <th>Meninggal</th>
                <td>{{ $user->dod }}</td>
            </tr>
            @endif
            @if ($user->email)
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            @endif
            <tr>
                <th>Telp</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{!! nl2br($user->address) !!}</td>
            </tr>
        </tbody>
    </table>
</div>