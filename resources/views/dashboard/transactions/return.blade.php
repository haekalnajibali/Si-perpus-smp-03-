@extends('dashboard.layouts.mainnew')

@section('container')
    <div class="row justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-error alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                    <form method="post" action="/dashboard/transactions/prosespengembalian">
                        @csrf
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
                        <button class="btn btn-primary" type="submit">Lakukan Pengembalian</button>
                    </form>
                </div>
            </div>
        </div>
        <button id="changeValueBtn">Change Value</button>
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
    @endpush
