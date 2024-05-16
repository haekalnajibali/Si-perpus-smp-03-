@extends('dashboard.layouts.mainnew')

@section('container')
<style>
    /* .card {
            background-image: linear-gradient(to right, rgba(255, 0, 0, 0), rgb(76, 121, 255));
        } */
</style>
<link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
<div class="container py-5">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card mb-3">
        <div class=" card-header">Laporan</div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <a href="/dashboard/reports/books" class="btn btn-sm btn-primary">Cetak Laporan Buku</a>
                    <a href="/dashboard/reports/users" class="btn btn-sm btn-primary">Cetak Laporan Petugas</a>
                    <a href="/dashboard/reports/members" class="btn btn-sm btn-primary">Cetak Laporan Anggota</a>
                </div>
                <form method="post" action="/dashboard/reports/transactions">
                  @csrf
                  <div class="row">
                    <div class="col-2">
                      <div class="col">
                        <p class="mb-0">Tanggal Awal</p>
                      </div>
                      <input type="date" class="form-control" id="kembali" name="tgl_awal" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="col-2">
                      <div class="col">
                        <p class="mb-0">Tanggal Akhir</p>
                      </div>
                      <input type="date" class="form-control" id="kembali" name="tgl_akhir" value="<?php echo date('Y-m-d'); ?>" >
                    </div>
                    <div class="col-4">
                      <div class="col">
                        <p class="mb-4"></p>
                      </div>
                        <button class="btn btn-primary" type="submit">Cetak Laporan Transaksi</button>
                      </div>
                    </div>
                </form>
                <div class="col-6 mt-4 mb-md-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">Buku</h6>
                            {{-- <p class="text-sm mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span> in 2021
                            </p> --}}
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="buku" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-4 mb-md-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">Transaksi</h6>
                            {{-- <p class="text-sm mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span> in 2021
                            </p> --}}
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="transaksi" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<script src="{{ asset('argon/js/plugins/chartjs.min.js')}}"></script>
<script>
    var transaksi = document.getElementById("transaksi").getContext("2d");
    // console.log("Hello world!");
    var gradientStroke1 = transaksi.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(transaksi, {
      type: "line",
      data: {
        // labels: [datalabel],
        labels: <?php echo $labeltransaksi ?>,
        datasets: [{
          label: "Transaksi",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: {{ json_encode($banyaktransaksi)}},
        // data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
    var buku = document.getElementById("buku").getContext("2d");
    // console.log("Hello world!");
    var gradientStroke2 = buku.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(111,66,193, 0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(111,66,193, 0.0)');
    gradientStroke2.addColorStop(0, 'rgba(111,66,193, 0)');
    new Chart(buku, {
      type: "line",
      data: {
        // labels: [datalabel],
        labels: <?php echo $labelbuku ?>,
        datasets: [{
          label: "Buku",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#6f42c1",
          backgroundColor: gradientStroke2,
          borderWidth: 3,
          fill: true,
          data: {{ json_encode($banyakbuku)}},
        // data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
</script>
@endsection