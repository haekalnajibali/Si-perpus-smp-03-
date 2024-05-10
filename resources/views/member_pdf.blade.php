<!DOCTYPE html>
<html>

<head>
    <title>Laporan Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>

    <center>
        <h5>Laporan Anggota SMP Negeri 03 Kota Bengkulu
        </h4>
            <h6>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114
        </h5>
    </center>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">NISN</th>
                <th scope="col">Tempat, Tanggal Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Jenis Anggota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr>
                <td>{{ $member->nama }}</td>
                <td>{{ $member->nisn }}</td>
                <td>{{ $member->tmpt_lahir }}, {{ $member->tgl_lahir }}</td>
                <td>{{ $member->jns_kelamin }}</td>
                <td>{{ $member->alamat }}</td>
                <td>{{ $member->no_hp }}</td>
                <td>{{ $member->jns_anggota }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><br><br><br><br>Kepala Perpustakaan <br><br><br>
        <br>Harun Nur Rasyid, S.Pd<br>NIP.19680524 199702 1 001</p>
</body>

</html>