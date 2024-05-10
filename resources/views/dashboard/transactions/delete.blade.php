@extends('dashboard.layouts.mainnew')

@section('container')
<div class="row py-5 justify-content-center">
    <div class="col-lg-10">
        <div class="card mb-4">
            <div class="card-body"> 
                <form method="post" action="/dashboard/transactions/proseshapus">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Buku yang Dipinjam</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="book" required
                                value="{{ $transaction->book->judul }}" readonly>
                        </div>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" name="id" required value="{{ $transaction->id }}"
                                readonly>
                        </div>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" name="book_id" required
                                value="{{ $transaction->book_id }}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">

                        </div>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" name="user_id" required
                                value="{{ $transaction->user_id }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nama Peminjam</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="user_id" required
                                value="{{ $transaction->member->nama }}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Tanggal Peminjaman</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" id="pinjam" class="form-control" name="tgl_pinjam"
                                value="{{ $transaction->tgl_pinjam }}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Tenggat Pengembalian</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tgl_kembali" value="<?php
                                        echo date('Y-m-d', strtotime($transaction->tgl_pinjam . ' + 7 day')); ?>"
                                readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Jumlah Eksemplar yang Dipinjam (Jangan melebihi eksemplar
                                tersedia)</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="jml_pinjam" required id="eksemplarubah"
                                value="{{ $transaction->jml_pinjam }}" readonly>
                        </div>
                    </div>
                    <hr>
                    <button class="badge bg-danger border-0"
                    onclick="return confirm('Anda Yakin?')" type="submit">Hapus Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function PinjamFunction() {
            var datepinjam = new Date($('#pinjam').val());
            var datekembali = new Date($('#kembali').val());

            var difference = datekembali.getTime() - datepinjam.getTime();
            var Difference_In_Days = difference / (1000 * 3600 * 24);
            document.getElementById("hasil").value = Difference_In_Days;

            if (Difference_In_Days > 7) {
                var haridenda = Difference_In_Days - 7;
                var denda = 500 * haridenda;
                document.getElementById("denda").value = denda;
            } else {
                document.getElementById("denda").value = 0;
            }
        }

        function EksemplarFunction() {
            var eksemplarawal = document.getElementById("eksemplarawal").value;
            var eksemplarubah = document.getElementById("eksemplarubah").value;
        }
</script>
@endsection