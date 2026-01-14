<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width,  nitial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        Dashboard - Aduan
    </title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.menu')
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    @include('layouts.navbar')
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold m-0 text-primary">
                                <span class="text-muted fw-light">Akun /</span> Riwayat Aduan Saya
                            </h4>
                            <a href="{{ route('bikinaduan') }}" class="btn btn-primary rounded-pill shadow-sm">
                                <i class='bx bx-plus me-1'></i> Buat Aduan Baru
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm rounded-4 overlay-hidden">
                                    <div class="card-header bg-white py-3 border-bottom-0">
                                        <h5 class="fw-bold mb-0 text-dark">Daftar Laporan Kehilangan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table id="aduanUserTable" class="table table-hover align-middle">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th class="fw-bold text-uppercase small text-muted">ID</th>
                                                        <th class="fw-bold text-uppercase small text-muted">Foto</th>
                                                        <th class="fw-bold text-uppercase small text-muted">Barang</th>
                                                        <th class="fw-bold text-uppercase small text-muted">Tanggal</th>
                                                        <th class="fw-bold text-uppercase small text-muted">Status</th>
                                                        <th class="fw-bold text-uppercase small text-muted text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($aduans as $aduan)
                                                    <tr>
                                                        <td><span class="fw-semibold text-dark">#{{ $aduan->id }}</span></td>
                                                        <td>
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ Storage::url('public/assets/img/aduan/').$aduan->foto }}" 
                                                                     alt="Foto Barang" class="rounded-3 shadow-sm h-100 w-100" 
                                                                     style="object-fit: cover;">
                                                            </div>
                                                        </td>
                                                        <td><span class="fw-medium">{{ $aduan->namabarang }}</span></td>
                                                        <td>{{ \Carbon\Carbon::parse($aduan->created_at)->translatedFormat('d M Y, H:i') }}</td>
                                                        <td>
                                                            @if ($aduan->status =='0')
                                                                <span class="badge bg-label-warning rounded-pill px-3">Menunggu Verifikasi</span>
                                                            @elseif ($aduan->status =='1')
                                                                <span class="badge bg-success rounded-pill px-3">Diterima</span>
                                                            @else
                                                                <span class="badge bg-danger rounded-pill px-3">Ditolak</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                                href="{{ route('detailaduan',['id'=>$aduan->id]) }}">
                                                                <i class="bx bx-show me-1"></i> Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center py-5">
                                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                                <img src="{{ asset('assets/img/illustrations/girl-doing-yoga-light.png') }}" width="150" class="mb-3" alt="No data">
                                                                <h6 class="text-muted fw-bold">Belum ada aduan yang dibuat</h6>
                                                                <a href="{{ route('bikinaduan') }}" class="btn btn-sm btn-primary mt-2">Buat Sekarang</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var indonesianLanguage = {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(difilter dari _MAX_ total entri)",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "emptyTable": "Kamu tidak memiliki aduan.",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            };

            $('#aduanUserTable').DataTable({
                "language": indonesianLanguage,
                "order": [
                    [2, "desc"]
                ]
            });
        });
    </script>
</body>

</html>