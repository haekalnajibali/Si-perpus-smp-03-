<!DOCTYPE html>
<html>

<head>
    <title>Cetak Kartu Petugas</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <div class="col">
            <div class="py-1 px-2" style="width: 14cm; height: 5.6cm;">
                <div class="card" style="height: 7cm; background-color: #80e3ff;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <img class="img" style="height: 70px; width:70px;"
                                    src="{{ asset('storage/images/logo.png') }}" />
                            </div>
                            <div class="col-10">
                                <h6 style="font-size: 12pt; font-weight:bold; line-height: 0.5;">
                                    <center>SMP NEGERI 03 KOTA BENGKULU</center>
                                </h6>
                                <h6 style="font-size: 8pt;">
                                    <center>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114</center>
                                </h6>
                                <h6 style="font-size: 10pt; font-weight:bold;">
                                    <center>KARTU PETUGAS PERPUSTAKAAN</center>
                                </h6>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9" style="padding-right: 0px">
                                <table class="table table-borderless table-sm"
                                    style="font-size: 10pt; font-weight:lighter;">
                                    <thead>
                                        <tr>
                                            <th scope="col-4"></th>
                                            <th scope="col-1"></th>
                                            <th scope="col-4"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>:</th>
                                            <th>{{ $user->nama }}</th>
                                        </tr>
                                        <tr>
                                            <th>NIP</th>
                                            <th>:</th>
                                            <th>{{ $user->nip }}</th>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <th>:</th>
                                            <th>{{ $user->jabatan }}</th>
                                        </tr>
                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <th>:</th>
                                            <th>{{ $user->no_tlp }}</th>
                                        </tr>
                                        <tr>
                                            <th>E-mail</th>
                                            <th>:</th>
                                            <th>{{ $user->email }}</th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3 justify-content-center" style="padding: 0px">
                                <br>
                                <img src="{{ asset('storage/images/' . $user->nama_gambar) }}" class="rounded"
                                    style="height: 3cm; width:3cm;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="py-1 px-2" style="width: 14cm; height: 5.6cm;">
                <div class="card" style="height: 7cm; background-color: #80e3ff;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <img class="img" style="height: 70px; width:70px;"
                                    src="{{ asset('storage/images/logo.png') }}" />
                            </div>
                            <div class="col-10">
                                <h6 style="font-size: 12pt; font-weight:bold; line-height: 0.5;">
                                    <center>SMP NEGERI 03 KOTA BENGKULU</center>
                                </h6>
                                <h6 style="font-size: 8pt;">
                                    <center>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114</center>
                                </h6>
                                <h6 style="font-size: 10pt; font-weight:bold;">
                                    <center>KARTU PETUGAS PERPUSTAKAAN</center>
                                </h6>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9" style="padding-right: 0px">
                                <table class="table table-borderless table-sm"
                                    style="font-size: 10pt; font-weight:lighter;">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Catatan</th>
                                        </tr>
                                        <tr>
                                            <th>1. Kartu harap disimpan dengan baik</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
        </div>
    </div>
</body>

</html>