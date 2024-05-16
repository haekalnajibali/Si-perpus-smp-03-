@extends('dashboard.layouts.mainnew')

@section('container')
<style>
    /* .card {
            background-image: linear-gradient(to right, rgba(255, 0, 0, 0), rgb(76, 121, 255));
        } */
</style>
<div class="container py-5">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card mb-3">
        <div class=" card-header">Data Transaksi</div>

        <div class="card-body">
            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                        <div>
                            <p>Cari berdasarkan Judul atau Nama Peminjam</p>
                        </div>
                    </div>
                </div>
                <form action="/dashboard/transactions">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <a href="/dashboard/transactions/create" class="btn btn-lg btn-primary mx-4">Tambah Transaksi Peminjaman</a>
        <a href="/dashboard/pengembalians" class="btn btn-lg btn-primary mx-4">Pengembalian</a>
    </div>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Buku yang Dipinjam</th>
                                <th scope="col">Nama Petugas</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Tanggal Peminjaman</th>
                                <th scope="col">Tenggat Waktu</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Status</th>
                                <th scope="col">Denda</th>
                                <th scope="col">Jumlah Pinjam</th>
                                <th scope="col">Jumlah Hari</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td class="align-middle text-center">{{ $a++ }}</td>
                                <td>{{ $transaction->book->judul }}</td>
                                <td>{{ $transaction->user->nama }}</td>
                                <td>{{ $transaction->member->nama }}</td>
                                <td>{{ $transaction->tgl_pinjam }}</td>
                                <td>{{ $transaction->tgl_kembali }}</td>
                                <td>{{ $transaction->tgl_pengembalian }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>{{ $transaction->denda }}</td>
                                <td>{{ $transaction->jml_hari }}</td>
                                <td>
                                    @if ($transaction->status == 'PEMINJAMAN')
                                    <a href="/dashboard/transactions/{{ $transaction->id }}/edit"
                                        class="badge bg-warning border-0">Edit</a>
                                    <form action="/dashboard/transactions/hapus" method="post"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" class="form-control" id="hasil" name="id" required readonly
                                            value="{{ $transaction->id }}">
                                        <button class="badge bg-danger border-0">Hapus</button>
                                    </form>
                                    @else
                                    <form action="/dashboard/transactions/{{ $transaction->id }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Anda Yakin?')">Hapus</button>
                                    </form>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @php
                        $currentpage = request('page')?request('page'):1;
                        $i = 1 + (10 * ( $currentpage- 1))
                        @endphp
                        <h6 class="mt-3 ml-2">Show {{ $i}} of {{ $count }}</h6>
        </div>
    </div>
</div>
@endsection