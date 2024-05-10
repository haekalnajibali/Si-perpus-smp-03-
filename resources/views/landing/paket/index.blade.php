@extends('landing.layouts.main')

@section('container')
<section class="mt-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 py-5 col-md-8 mx-auto">
            <h1 class="font-weight-normal">Kategori Buku</h1>
            <p class=" text-muted">Daftar Buku Dengan kategori ini</p>
        </div>
    </div>
</section>
<div class="album py-5 bg-light">
    <div class="container">
        <h1 class="fw-light text-center mt-5"></h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">Pengarang</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Eksemplar</th>
                        <th scope="col">Cover Buku</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $a = 1; ?>
                        @foreach ($books as $key => $book)
                        <td>{{ $books->firstItem() + $key }}</td>
                        <td>{{ $book->judul }}</td>
                        <td> {!! DNS1D::getBarcodeSVG($book->no_barcode, 'C128', 1.4, 50) !!}</td>
                        <td>{{ $book->pengarang }}</td>
                        <td>{{ $book->penerbit }}</td>
                        <td>{{ $book->thn_terbit }}</td>
                        <td>{{ $book->eksemplar }}</td>
                        <td><img class="" width="100px" height="150px"
                            src="{{ asset('storage/images/' . $book->nama_gambar) }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $books->links() }} </div>
        </div>
    </div>
</div>
</div>
@endsection