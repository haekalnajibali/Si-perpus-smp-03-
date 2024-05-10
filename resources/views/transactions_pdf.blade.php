<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        body {
            font-family: "Times New Roman", Times, serif;
        }

        table tr td,
        table tr th {
            font-size: 12pt;
        }

        h5 {
            font-size: 14pt;
        }

        h6{
            font-size: 10pt;
        }

        p{
            font-size: 12pt;
        }
    </style>

    <center>
        <h5>Laporan Transaksi SMP Negeri 03 Kota Bengkulu
        </h5>
        <h6>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114<br><br><br></h6>
    </center>
    <p>Transkasi tanggal ............ sampai ............</p>
    <table class="table table-bordered mt-4">
        <thead>
            <tr class="text-center justify-content-center">
                <th scope="col-2">Buku yang Dipinjam</th>
                <th scope="col-2">Nama Peminjam</th>
                <th scope="col-2">Tanggal Peminjaman</th>
                <th scope="col-2">Tanggal Pengembalian</th>
                <th scope="col-2">Denda Keterlambatan</th>
                <th scope="col-2">Jumlah Pinjam</th>

            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($transactions as $transaction)
                @php
                    $total += $transaction->denda;
                @endphp
                <tr class="text-center">
                    <td>{{ $transaction->book->judul }}</td>
                    <td>{{ $transaction->member->nama }}</td>
                    <td>{{ $transaction->tgl_pinjam }}</td>
                    <td>{{ $transaction->tgl_pengembalian }}</td>
                    <td>Rp {{ number_format($transaction->denda) }}</td>
                    <td>{{ $transaction->jml_pinjam }}</td>
                </tr>
            @endforeach
            <tr class="text-center">
                <td colspan="4">Total Denda</td>
                <td colspan="2">Rp {{ number_format($total) }}</td>
            </tr>
        </tbody>
    </table>
    <p><br><br><br><br>Kepala Perpustakaan <br><br><br><br>Harun Nur Rasyid, S.Pd<br>NIP.19680524 199702 1 001</p>
</body>

</html>
