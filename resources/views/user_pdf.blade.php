    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laporan Petugas</title>
        <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

<body>
    
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>

    <center>
        <h5>Laporan Petugas SMP Negeri 03 Kota Bengkulu

        </h4>
            <h6>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114
        </h5>
    </center>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">E-mail</th>


            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($users as $user)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->jabatan }}</td>
                <td>{{ $user->alamat }}</td>
                <td>{{ $user->no_tlp }}</td>
                <td>{{ $user->email }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <p><br><br><br><br>Kepala Perpustakaan <br><br><br><br>Harun Nur Rasyid, S.Pd<br>NIP.19680524 199702 1 001</p>
</body>

</html>