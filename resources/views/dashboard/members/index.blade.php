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
        <div class=" card-header">Data Anggota</div>
        <div class="card-body">
            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                        <div>
                            <p>Cari berdasarkan Nama</p>
                        </div>
                    </div>
                </div>
                <form action="/dashboard/members">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <a href="/dashboard/members/create" class="btn btn-lg btn-primary mx-4">Tambah Anggota</a>
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
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">NISN</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Jenis Anggota</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($members as $key => $member)
                                <td class="align-middle text-center">{{ $members->firstItem() + $key }}</td>
                                <td>{{ $member->nama }}</td>
                                <td>{{ $member->nisn }}</td>
                                <td>{{ $member->tmpt_lahir }}</td>
                                <td>{{ $member->tgl_lahir }}</td>
                                <td>{{ $member->jns_kelamin }}</td>
                                <td>{{ $member->alamat }}</td>
                                <td>{{ $member->no_hp }}</td>
                                <td>{{ $member->jns_anggota }}</td>
                                <td><img class="rounded-circle" width="100px"
                                        src="{{ asset('storage/images/' . $member->nama_gambar) }}">
                                </td>
                                <td>
                                    <a href="/dashboard/members/{{ $member->nisn }}/edit"
                                        class="badge bg-warning border-0">Edit</a>

                                    <form action="/dashboard/members/print" method="post" class="d-inline" target="_blank">
                                        @csrf
                                        <input type='hidden' name='id' value='{{ $member->id }}'>
                                        <button class="badge bg-primary border-0"
                                            onclick="return confirm('Cetak Kartu?')">Cetak
                                            Kartu</button>
                                    </form>

                                    <form action="/dashboard/members/{{ $member->nisn }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Anda Yakin?')">Hapus</button>
                                    </form>
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
<div class="d-flex justify-content-center">
    {{ $members->links() }} </div>

@endsection