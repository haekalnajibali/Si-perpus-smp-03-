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
        @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show text-white text-center" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card mb-3">
            <div class=" card-header">Data Kategori Rak</div>
            <div class="card-body"></div>
            <a href="/dashboard/raks/create" class="btn btn-lg btn-primary mx-4">Tambah Kategori Rak</a>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="align-items-center">
                                <tr>
                                    <th class="col-1">No.</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($raks as $key => $rak)
                                    <tr>
                                        <td class="align-middle text-center">{{ $raks->firstItem() + $key }}</td>
                                        <td>{{ $rak->kategori }}</td>
                                        <td><img width="100px" src="{{ asset('storage/images/' . $rak->nama_gambar) }}">
                                        </td>
                                        <td>
                                            <a href="/dashboard/raks/{{ $rak->id }}/edit"
                                                class="badge bg-warning border-0">Edit</a>

                                            <form action="/dashboard/raks/{{ $rak->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0"
                                                    onclick="return confirm('Data buku dengan kategori yang sama akan terhapus, Anda yakin menghapus kategori ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @php
                    $currentpage = request('page') ? request('page') : 1;
                    $i = 1 + 10 * ($currentpage - 1);
                @endphp
                <h6 class="mt-3 ml-2">Show {{ $i }} of {{ $count }}</h6>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $raks->links() }} </div>
    </div>
@endsection
