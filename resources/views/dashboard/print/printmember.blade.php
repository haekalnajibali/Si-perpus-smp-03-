<!DOCTYPE html>
<html>

<head>
    <title>Cetak Kartu Member</title>
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
                                    <center>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu,
                                        Bengkulu 38114</center>
                                </h6>
                                <h6 style="font-size: 10pt; font-weight:bold;">
                                    <center>KARTU ANGGOTA PERPUSTAKAAN</center>
                                </h6>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9" style="padding-right: 0px; line-height: 0.8;">
                                <table class="tableaa table-borderless table-sm"
                                    style="font-size: 10pt; font-weight:lighter;">
                                    <thead>
                                        <tr>
                                            <th scope="col-12"></th>
                                            <th scope="col-12"></th>
                                            <th scope="col-12"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>:</th>
                                            <th>{{ $member->nama }}</th>
                                        </tr>
                                        <tr>
                                            <th>NISN</th>
                                            <th>:</th>
                                            <th>{{ $member->nisn }}</th>
                                        </tr>

                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <th>:</th>
                                            <th>{{ $member->jns_kelamin }}</th>
                                        </tr>

                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <th>:</th>
                                            <th>{{ $member->no_hp }}</th>
                                        </tr>
                                        <tr>
                                            <th>Jenis Keanggotaan</th>
                                            <th>:</th>
                                            <th>{{ $member->jns_anggota }}</th>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <th>:</th>
                                            <th>{{ $member->alamat }}</th>
                                        </tr>
  

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-2 justify-content-center" style="padding: 0px; margin-top: 12px;"
                                <br>
                                <img src="{{ asset('storage/images/' . $member->nama_gambar) }}" class="rounded"
                                    style="height: 3cm; width:3cm;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

   
        <div class="row">
            <div class="row">
                <div class="row">
        <div class="col 6">
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
                                    <center>JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu,
                                        Bengkulu 38114</center>
                                </h6>
                                <h6 style="font-size: 10pt; font-weight:bold;">
                                    <center>KARTU ANGGOTA PERPUSTAKAAN</center>
                                </h6>
                                

                            </div>
                        </div>
                        <div class="row relative">
                            <div class="col-9" style="padding-right: 0px">
                                <table class="tableaa table-borderless table-sm"
                                    style="font-size: 10pt; font-weight:lighter;">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>- Kartu harap disimpan dengan baik <br>
                                                - Tunjukkan kartu ini untuk melakukan peminjaman</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="m-auto" >
                                {{-- <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($member->nisn, 'C128B', 3, 70) }}"
                                    alt="barcode"  /> --}}

                                    {!! DNS1D::getBarcodeSVG($member->nisn, 'C128B', 3, 70) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
        </div>
    </div>
    </div>
</body>

</html>
