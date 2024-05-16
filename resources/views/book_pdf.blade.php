<!DOCTYPE html>
<html>

<head>

    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
    <title>Laporan Buku</title>
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>SMP Negeri 03 Kota Bengkulu

        </h4>
            <h6>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114
        </h5>
    </center>
    <table class='table table-bordered'>
        <thead>
            <tr>

                <th scope="col">Kategori Rak</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">Eksemplar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>

                <td>{{ $book->rak->kategori ?? 'None' }}</td>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->pengarang }}</td>
                <td>{{ $book->penerbit }}</td>
                <td>{{ $book->thn_terbit }}</td>
                <td>{{ $book->eksemplar }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <p><br><br><br><br>Kepala Perpustakaan <br><br><br><br>
        Harun Nur Rasyid, S.Pd
        <br>NIP.19680524 199702 1 001</p>
</body>

</html>