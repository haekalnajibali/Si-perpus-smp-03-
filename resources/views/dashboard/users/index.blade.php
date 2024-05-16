@extends('dashboard.layouts.mainnew')

@section('container')
    <style>
        /* .card {
            background-image: linear-gradient(to right, rgba(255, 0, 0, 0), rgb(76, 121, 255));
        } */
        .table th, .table td {
        white-space: normal;
        /* word-wrap: break-word; */
    }
        .table th.jabatan-col, .table td.jabatan-col {
        max-width: 10px; /* Anda bisa menyesuaikan nilai ini */
    }
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
        <div class="card  mb-3">
            <div class=" card-header">Data Petugas</div>
            <div class="card-body">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col">
                            <div>
                                <p>Cari berdasarkan Nama</p>
                            </div>
                        </div>
                    </div>
                    <form action="/dashboard/users">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari..." name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        </div>

                    </form>
                </div>
            </div>
            <a href="/dashboard/users/create" class="btn btn-lg btn-primary mx-4">Tambah Petugas</a>
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
                                    <th scope="col">Nama <br>Lengkap</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col" class="jabatan-col">Alamat</th>
                                    <th scope="col">Nomor <br>Telepon</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Foto <br>Profil</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="align-middle text-center">{{ $users->firstItem() + $key }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->nip }}</td>
                                        <td>{{ $user->jabatan }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td>{{ $user->no_tlp }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><img width="100px" src="{{ asset('storage/images/' . $user->nama_gambar) }}">
                                        </td>
                                        <td>
                                            <a href="/dashboard/users/{{ $user->nip }}/edit"
                                                class="badge bg-warning border-0">Edit</a>

                                            <form action="/dashboard/users/print" method="post" class="d-inline"
                                                target="_blank">
                                                @csrf
                                                <input type='hidden' name='id' value='{{ $user->id }}'>
                                                <button class="badge bg-primary border-0"
                                                    onclick="return confirm('Cetak Kartu?')">Cetak
                                                    Kartu</button>
                                            </form>

                                            <form action="/dashboard/users/{{ $user->nip }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0 " 
                                                    onclick="return confirm('Anda Yakin?')">Hapus</button>
                                                   
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        {{ $users->links() }} </div>
@endsection
