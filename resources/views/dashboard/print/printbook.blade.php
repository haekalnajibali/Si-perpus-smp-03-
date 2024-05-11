<!DOCTYPE html>
<html>

<head>
    <title>Cetak Barcode Buku</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card py-5 mt-3 w-50">
            <div class="barcode text-center">
                <p class="name">{{ $book->judul }}</p>
                <p class="price">Pengarang: {{ $book->pengarang }}</p>
                <center>{!! DNS1D::getBarcodeSVG($book->no_barcode, 'C128B', 3, 70) !!}</center><br>
            </div>
        </div>
    </div>
</body>

</html>
