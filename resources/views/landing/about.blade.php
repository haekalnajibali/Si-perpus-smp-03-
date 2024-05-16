@extends('landing.layouts.main')

@section('container')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
    integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container py-5 mt-4">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mt-4 pt-2">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{ asset('storage/images/1.jpeg') }}" class="img-fluid" alt="Image"
                                    style="width: 100%; height:362px; object-fit: cover;" />
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->

                <div class="col-lg-6 col-md-6 col-6">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{ asset('storage/images/2.jpeg') }}" class="img-fluid" alt="Image"
                                    style="width: 100%; height:350px; object-fit: cover;" />
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-lg-12 col-md-12 mt-4 pt-2">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{ asset('storage/images/3.jpeg') }}" class="img-fluid" alt="Image"
                                    style="width: 350px; height:300px; object-fit: cover;" />
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end col-->

        <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
            <div class="section-title ml-lg-5">
                <h5 class="text-custom font-weight-normal mb-3">Tentang Kami</h5>
                <h4 class="title mb-4">
                    SI Perpus <br />
                    Sistem Informasi Perpustakaan SMP Negeri 3 Kota Bengkulu
                </h4>
                <p class="text-muted mb-3">SI Perpus adalah situs perpustakaan SMP Negeri 3 Kota Bengkulu. SI Perpus
                    memiliki fitur OPAC (Open Public Access Catalog), Helper (Bantuan), fitur pinjam-kembali buku yang
                    sangat memudahkan siswa dalam mengakses perpustakaan.</p>

                <a href="#visimisi" class="btn  btn-outline-primary btn-lg mx-1">Visi dan Misi</a>
                <a href="#struktur" class="btn  btn-outline-primary btn-lg mx-1">Struktur Organisasi</a>
                <a href="#kontak" class="btn  btn-outline-primary btn-lg mx-1">Kontak dan Lokasi</a>
            </div>
        </div>
    </div>
    <div class="row pb-0 align-items-center rounded-3 border shadow-lg mb-5" id="visimisi">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <div class="lc-block mb-3">
                <div editable="rich">
                    <h4 class="title">Visi dan Misi</h4>
                </div>
            </div>
            <div class="lc-block mb-3">
                <div editable="rich">
                    <h4 class="title">Visi</h4>
                    <p style="text-align: justify">Menjadi pusat pendidikan yang berkualitas, menciptakan lingkungan belajar yang inklusif, dan menginspirasi siswa untuk mencapai prestasi akademik dan pengembangan pribadi yang optimal. 
                    </p>
                    <h4 class="title">Misi</h4>
                    <p style="text-align: justify">1. Memberikan pendidikan berkualitas tinggi yang berpusat pada pembangunan karakter, pengetahuan, dan keterampilan siswa-siswi.</p>
                    <p style="text-align: justify">2. Mendorong pengembangan potensi siswa dalam bidang akademik, seni, dan olahraga melalui pendekatan pembelajaran yang inovatif dan berbasis teknologi.</p>
                    <p style="text-align: justify">3. Menyediakan lingkungan belajar yang aman, nyaman, dan inklusif yang memfasilitasi pertumbuhan intelektual, emosional, dan sosial siswa.</p>
                    <p style="text-align: justify">4. Melibatkan siswa, orang tua, dan komunitas dalam proses pendidikan untuk memastikan keterlibatan aktif dalam pembangunan karakter dan prestasi akademik siswa.</p>
                    <p style="text-align: justify">5. Menjunjung tinggi nilai-nilai moral dan etika dalam setiap aspek kegiatan sekolah serta mendorong siswa untuk menjadi agen perubahan positif dalam masyarakat.</p>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
            <div class="lc-block"><img class="rounded" src="{{ asset('storage/images/2.jpeg') }}"
                    style="width: 100%; height:500px; object-fit: cover;"></div>
        </div>
    </div>
    <div class="row pb-0  align-items-center rounded-3 border shadow-lg mb-5" id="struktur">
        <div class="col-lg-4  p-0 overflow-hidden shadow-lg ml-2">
            <div class="lc-block"><img class="rounded" src="{{ asset('storage/images/1.jpeg') }}"
                    style="width: 100%; height:515px; object-fit: cover;"></div>
        </div>
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <div class="lc-block mb-3">
                <div editable="rich">
                    <h4 class="title">Struktur Organisasi Perpustakaan SMP Negeri 03  </h4>

                </div>
            </div>
            <div class="lc-block mb-3">
                <div editable="rich">
                    <h4 class="title">Kepala Sekolah</h4>
                    <p class="lead">Satrul Azis, S.Pd., M.Pd <br>
                        NIP. 19690106 109801 1 002
                    </p>
                    <h4 class="title">KA. Perpustakaan</h4>
                    <p class="lead">Harunnurrasyid, S.Pd <br>
                        NIP. 19690106 109801 1 002
                    <h4 class="title">Petugas Perpustakaan</h4>
                    <p class="lead">Anissa Desty Khairoeni, S.Pd <br> </p>

 
                </div>
            </div>
        </div>

    </div>
    <div class="row pb-0  align-items-center rounded-3 border shadow-lg mb-5" id="kontak">
        <div class="col">
            <div class="p-3">

                <h4 class="title">Lokasi</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15924.362668928936!2d102.260819!3d-3.7904346!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e36b0262b5b1e71%3A0xa7aec3721c7533c6!2sSMP%20Negeri%203%20Bengkulu!5e0!3m2!1sid!2sid!4v1714240750592!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="col">
            <div class="p-3">
                <h4 class="title">Kontak Kami</h4>
                <p><i class="fa fa-map-marker-alt" ></i> Tembah Padang, JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114</p>
                <p><i class="bi bi-telephone"></i> (0736) 22369 </p>
            </div>
        </div>
    </div>
    @endsection