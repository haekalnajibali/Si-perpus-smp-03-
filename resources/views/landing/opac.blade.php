@extends('landing.layouts.main')

@section('container')
    <section class="mt-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 py-1 col-md-8 mx-auto">
                <h1 class="font-weight-normal">Lihat Buku</h1>
                <p class=" text-muted">Jelajahi fitur OPAC dengan menggunakan fitur cari nama buku dan berbagai informasi buku</p>
                <p>
                <div class="container mt-3">
                    <div class="row">
                        <div class="col">
                            <div>
                                <p>Cari berdasarkan judul buku</p>
                            </div>
                        </div>
                    </div>
                    <form action="/opac">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control text-black" placeholder="Cari..." name="search"
                                value="{{ request('search') }}" autofocus>
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                </p>
            </div>
        </div>
    </section>
    <div class="album py-3 bg-light">
        <div class="container">
            <h1 class="fw-bold text-center">Kategori Buku</h1>
            <p class="text-muted text-center">Lihat daftar kategori buku dibawah ini</p><br>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($raks as $key => $rak)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="50%" height="100"
                                src="{{ asset('storage/images/' . $rak->nama_gambar) }}">
                            <div class="card-body">
                                <p class="card-text">{{ $rak->kategori }}</p>
                                <div class="d-flex justify-content-between align-items-center">

                                    <form action="/opac/paket" method="post" class="d-inline">
                                        @csrf
                                        <input type='hidden' name='kategori' value="{{ $rak->kategori }}">
                                        <button class="btn btn-sm btn-outline-secondary" type="submit">Lihat Buku</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col">
                    <div class="d-flex justify-content-center">
                        {{ $raks->links() }} </div>
                </div>
            </div>
            <h1 class="fw-bold text-center mt-5">Daftar Buku</h1>
            <p class="text-muted text-center">Lihat daftar buku dibawah ini</p><br>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kategori Rak</th>
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
                            @foreach ($books as $key => $book)
                                <td>{{ $books->firstItem() + $key }}</td>
                                <td>{{ $book->rak->kategori ?? 'None' }}</td>
                                <td>{{ $book->judul }}</td>
                                <td> {!! DNS1D::getBarcodeSVG($book->no_barcode, 'EAN13', 3, 70) !!}</td>
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

            </div>
            <div class="row justify-content-center mt-4">
                <div class="col">
                    <div class="d-flex justify-content-center">
                        {{ $books->links() }} </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
