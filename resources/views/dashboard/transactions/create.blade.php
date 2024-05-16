@extends('dashboard.layouts.mainnew')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="mb-2">Scan barcode</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 m-auto">
                            <video id="video" style="height: 20rem; width: 40rem;" autoplay></video>
                            @csrf
                        </div>
                    </div>
                    <hr>
                    <form method="post" action="/dashboard/transactions">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-warning">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Buku yang Dipinjam</p>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-select" id="buku" name="book_id">
                                    <option value="" selected>Pilih Buku</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->judul }} | Eksemplar Tersedia :
                                            {{ $book->eksemplar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="user_id" required
                                    value="{{ Auth::id() }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nama Peminjam</p>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-select" id="peminjam" name="member_id">
                                    <option value="" selected>Pilih Peminjam</option>
                                    @foreach ($members as $member)
                                        @if (old('member_id') == $member->nisn)
                                            <option value="{{ $member->nisn }}" selected>{{ $member->nama }}
                                            </option>
                                        @else
                                            <option value="{{ $member->nisn }}">{{ $member->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tanggal Peminjaman</p>
                            </div>
                            <div class="col-sm-9">
                                <input type="date" id="pinjam" class="form-control" name="tgl_pinjam"
                                    value="<?php echo date('Y-m-d'); ?>" readonly>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tenggat Pengembalian</p>
                            </div>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_kembali" value="<?php
                                // $Date1 = date('Y-m-d');
                                // echo date('Y-m-d', strtotime($Date1 . ' + 7 day')); ?>"
                                    readonly>
                            </div>
                        </div>
                        <hr> --}}

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tenggat Pengembalian</p>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-control" name="tenggat_pengembalian" onchange="updateTanggal()">
                                    <option value="7">7 Hari</option>
                                    <option value="180">180 Hari</option>
                                    <option value="365">365 Hari</option>
                                </select>
                                <?php
                                    $Date1 = date('Y-m-d');
                                    $tgl_kembali_7 = date('Y-m-d', strtotime($Date1 . ' + 7 day'));
                                    $tgl_kembali_180 = date('Y-m-d', strtotime($Date1 . ' + 180 day'));
                                    $tgl_kembali_365 = date('Y-m-d', strtotime($Date1 . ' + 365 day'));
                                ?>
                                <input type="date" class="form-control mt-2" id="tgl_kembali" name="tgl_kembali" value="<?php echo $tgl_kembali_7; ?>" readonly>
                            </div>
                        </div>
                        
<br>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Jumlah Eksemplar yang Dipinjam (Jangan melebihi eksemplar
                                    tersedia)</p>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jml_pinjam" required id="eksemplarubah" value='1' readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Jenis Transaksi</p>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-select" name="status" onchange="yesnoCheck(this);">
                                    <option value="PEMINJAMAN">PEMINJAMAN
                                    </option>
                                    {{-- <option value="PENGEMBALIAN">PENGEMBALIAN
                                </option> --}}
                                </select>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary" type="submit">Tambahkan Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            // Your existing code
            $(document).ready(function() {
                $('#buku').selectize({
                    sortField: 'text'
                });
            });
            $(document).ready(function() {
                $('#peminjam').selectize({
                    sortField: 'text'
                });
            });
        </script>
    @endsection

    @push('scripts')
        <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 900,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer
                    toast.onmouseleave = Swal.resumeTimer
                }
            });

            const startQRCodeScan = () => {
                try {
                    const codeReader = new ZXing.BrowserBarcodeReader();
                    codeReader.getVideoInputDevices(undefined, 'video')
                        .then(result => {
                            if (result && result.length) {
                                return codeReader.decodeFromInputVideoDevice(result[0].deviceId, 'video');
                            } else {
                                throw new Error('No video input devices found.');
                            }
                        })
                        .then(scanResult => {
                            const barCodeFromReader = scanResult.text;
                            const formData = new FormData();
                            formData.append('barcode', barCodeFromReader);

                            const csrfToken = $('input[name="_token"]').val();
                            formData.append('_token', csrfToken);

                            return $.ajax({
                                url: '/api/peminjaman/',
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false
                            });
                        })
                        .then(data => {
                            if (data.type == 'success') {
                                if (data.book) {
                                    const bookId = data.book;
                                    $('#buku').val(bookId.toString()).change();
                                }

                                if (data.member) {
                                    const memberId = data.member;
                                    $('#peminjam').val(memberId.toString()).change();
                                }
                            }

                            Toast.fire({
                                icon: data.type === 'success' ? 'success' : 'error',
                                title: data.message
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Toast.fire({
                                icon: 'error',
                                title: error.message || 'An error occurred. Please try again later.'
                            });
                        })
                        .finally(() => {
                            setTimeout(startQRCodeScan(), 1000);
                        });
                } catch (error) {
                    console.error('Error:', error);
                    Toast.fire({
                        icon: 'error',
                        title: error.message || 'An error occurred. Please try again later.'
                    });
                }
            };

            $(document).ready(() => {
                startQRCodeScan();
            });
        </script>
        
        <script>
            function updateTanggal() {
                var selectedValue = document.getElementsByName("tenggat_pengembalian")[0].value;
                var tgl_kembali = document.getElementById("tgl_kembali");
                var Date1 = new Date();
        
                if (selectedValue == "7") {
                    Date1.setDate(Date1.getDate() + 7);
                } else if (selectedValue == "180") {
                    Date1.setDate(Date1.getDate() + 180);
                } else if (selectedValue == "365") {
                    Date1.setDate(Date1.getDate() + 365);
                }
        
                var year = Date1.getFullYear();
                var month = String(Date1.getMonth() + 1).padStart(2, '0');
                var day = String(Date1.getDate()).padStart(2, '0');
        
                var formattedDate = year + '-' + month + '-' + day;
                tgl_kembali.value = formattedDate;
            }
        </script>
        
    @endpush
