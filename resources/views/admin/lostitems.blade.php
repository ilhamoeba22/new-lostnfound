<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        Dashboard
    </title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>

    <script src="{{ asset('assets') }}/js/config.js"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- menu --}}

            @include('layouts.menu-admin')
            {{-- end menu --}}

            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    @include ('layouts.navbar')
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">Data /</span>
                            Aduan
                        </h4>

                        <div class="row">
                            <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded-4 overlay-hidden">
                            <div class="card-header bg-white py-3">
                                <h5 class="fw-bold mb-0 text-primary">Daftar Aduan Barang Hilang</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table id="aduanTable" class="table table-hover align-middle">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="fw-bold text-uppercase small text-muted">ID</th>
                                                <th class="fw-bold text-uppercase small text-muted">Foto</th>
                                                <th class="fw-bold text-uppercase small text-muted">Pelapor</th>
                                                <th class="fw-bold text-uppercase small text-muted">Barang</th>
                                                <th class="fw-bold text-uppercase small text-muted">Kategori</th>
                                                <th class="fw-bold text-uppercase small text-muted">Stasiun</th>
                                                <th class="fw-bold text-uppercase small text-muted">Tanggal</th>
                                                <th class="fw-bold text-uppercase small text-muted">Kode Booking</th>
                                                <th class="fw-bold text-uppercase small text-muted">Status</th>
                                                <th class="fw-bold text-uppercase small text-muted">Aksi</th>
                                            </tr>
                                            <tr class="filters">
                                                <th><input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Filter ID" /></th>
                                                <th></th>
                                                <th><input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Filter Nama" /></th>
                                                <th><input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Filter Barang" /></th>
                                                <th><input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Filter Kat." /></th>
                                                <th><input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Filter Sta." /></th>
                                                <th><input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Filter Tgl." /></th>
                                                <th><input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Filter Kode" /></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($collection as $aduan)
                                            <tr>
                                                <td>
                                                    <span class="fw-semibold text-dark">#{{ $aduan->id }}</span>
                                                </td>
                                                <td>
                                                    <img src="{{ Storage::url('public/assets/img/aduan/').$aduan->foto }}" 
                                                         alt="Avatar" class="rounded-3 shadow-sm" width="50" height="50" 
                                                         style="object-fit: cover; cursor: pointer;"
                                                         onclick="window.open(this.src)">
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="fw-semibold text-dark">{{ $aduan->user->name }}</span>
                                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $aduan->user->email ?? '-' }}</small>
                                                    </div>
                                                </td>
                                                <td class="fw-medium">{{ $aduan->namabarang }}</td>
                                                <td><span class="badge bg-label-secondary rounded-pill">{{ $aduan->kategori->nama }}</span></td>
                                                <td>{{ $aduan->stasiun->nama}}</td>
                                                <td>{{ \Carbon\Carbon::parse($aduan->created_at)->format('d M Y') }}</td>
                                                <td>
                                                    @if($aduan->kode_booking)
                                                        <span class="badge bg-label-info rounded-pill">{{ $aduan->kode_booking }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($aduan->status == '1')
                                                        <span class="badge bg-success rounded-pill px-3">Diterima</span>
                                                    @elseif($aduan->status == '2')
                                                        <span class="badge bg-danger rounded-pill px-3">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-warning rounded-pill px-3">Menunggu</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm"
                                                        href="{{ route('detaillostitems',['id'=>$aduan->id]) }}">
                                                        <i class="bx bx-show me-1"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
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
    <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('assets') }}/vendor/js/menu.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>

    <script src="{{ asset('assets') }}/js/pages-account-settings-account.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var indonesianLanguage = {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entSri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(difilter dari _MAX_ total entri)",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "emptyTable": "Tidak ada data yang tersedia di tabel",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            };

            var table = $('#aduanTable').DataTable({
                "language": indonesianLanguage,
            });

            $('#aduanTable .filters th').each(function(i) {
                var filterControl = $(this).find('input');

                if (filterControl.length > 0) {
                    filterControl.on('keyup change', function() {
                        if (table.column(i).search() !== this.value) {
                            table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>