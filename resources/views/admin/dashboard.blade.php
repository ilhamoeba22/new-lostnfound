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
                        
                        <!-- Welcome & Date -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="fw-bold py-3 mb-0 text-dark">Dashboard Admin</h4>
                                <p class="text-muted small mb-0">Ringkasan aktivitas dan statistik terbaru.</p>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-label-primary rounded-pill px-3 py-2">
                                    <i class='bx bx-calendar me-1'></i> {{ date('d F Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Statistics Overview -->
                        <div class="row g-4 mb-4">
                            <!-- Total Lost Items -->
                            <div class="col-md-3">
                                <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="avatar bg-label-danger rounded p-2">
                                                <i class='bx bx-search-alt fs-3'></i>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="{{ route('lostitems') }}">Lihat Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="card-title mb-1 fw-bold text-dark">{{ $lostitem }}</h3>
                                        <small class="d-block text-muted">Total Laporan Kehilangan</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Found Items -->
                            <div class="col-md-3">
                                <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="avatar bg-label-success rounded p-2">
                                                <i class='bx bx-box fs-3'></i>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                                    <a class="dropdown-item" href="{{ route('items') }}">Lihat Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="card-title mb-1 fw-bold text-dark">{{ $founditem->count() }}</h3>
                                        <small class="d-block text-muted">Barang Ditemukan</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Pending Verifications (Placeholder Data) -->
                            <div class="col-md-3">
                                <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="avatar bg-label-warning rounded p-2">
                                                <i class='bx bx-time-five fs-3'></i>
                                            </div>
                                        </div>
                                        <h3 class="card-title mb-1 fw-bold text-dark">{{ $aduan->where('status', '0')->count() }}</h3>
                                        <small class="d-block text-muted">Laporan Diproses</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Success (Placeholder Data) -->
                            <div class="col-md-3">
                                <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="avatar bg-label-info rounded p-2">
                                                <i class='bx bx-check-circle fs-3'></i>
                                            </div>
                                        </div>
                                        <h3 class="card-title mb-1 fw-bold text-dark">{{ $aduan->where('status', '1')->count() }}</h3>
                                        <small class="d-block text-muted">Laporan Selesai</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activities Tabs -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-0 shadow-sm rounded-4">
                                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                                        <h5 class="m-0 fw-bold text-dark"><i class='bx bx-list-ul me-2 text-primary'></i>Data Terbaru</h5>
                                        
                                        <ul class="nav nav-pills card-header-pills" id="dashboardTabs" role="tablist">
                                            <li class="nav-item">
                                                <button class="nav-link active rounded-pill btn-sm" id="tab-items" data-bs-toggle="tab" data-bs-target="#navs-top-items" type="button" role="tab">
                                                    Barang Hilang (Aduan)
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link rounded-pill btn-sm" id="tab-lost" data-bs-toggle="tab" data-bs-target="#navs-top-lost" type="button" role="tab">
                                                    Barang Ditemukan
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="card-body p-0">
                                        <div class="tab-content" id="dashboardTabsContent">
                                            
                                            <!-- Lost Items Tab -->
                                            <div class="tab-pane fade show active" id="navs-top-items" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-hover align-middle mb-0">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="ps-4">ID & Nama Barang</th>
                                                                <th>Tanggal</th>
                                                                <th>Lokasi & Kategori</th>
                                                                <th>Status</th>
                                                                <th class="text-end pe-4">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($aduan->sortByDesc('created_at')->take(5) as $items)
                                                            <tr>
                                                                <td class="ps-4">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar avatar-sm bg-label-secondary me-3 rounded p-1">
                                                                            <i class='bx bx-cube-alt'></i>
                                                                        </div>
                                                                        <div>
                                                                            <span class="d-block fw-semibold text-dark">{{ $items->namabarang }}</span>
                                                                            <small class="text-muted">ID: #{{ $items->id }}</small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $items->created_at->format('d M Y') }}</td>
                                                                <td>
                                                                    <span class="d-block text-dark">{{ $items->stasiun ? $items->stasiun->nama : '-' }}</span>
                                                                    <small class="text-muted">{{ $items->kategori->nama }}</small>
                                                                </td>
                                                                <td>
                                                                    @if ($items->status == '0')
                                                                        <span class="badge bg-label-warning rounded-pill">Diproses</span>
                                                                    @elseif ($items->status == '1')
                                                                        <span class="badge bg-label-success rounded-pill">Selesai</span>
                                                                    @else
                                                                        <span class="badge bg-label-danger rounded-pill">Ditolak</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-end pe-4">
                                                                    <a class="btn btn-sm btn-label-primary rounded-pill" href="{{ route('detaillostitems', ['id' => $items->id]) }}">
                                                                        Detail
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer bg-white border-top text-center py-3">
                                                    <a href="{{ route('lostitems') }}" class="btn btn-primary btn-sm rounded-pill">Lihat Semua Laporan</a>
                                                </div>
                                            </div>

                                            <!-- Found Items Tab -->
                                            <div class="tab-pane fade" id="navs-top-lost" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-hover align-middle mb-0">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="ps-4">Nama Barang</th>
                                                                <th>Tanggal Ditemukan</th>
                                                                <th>Kategori</th>
                                                                <th class="text-end pe-4">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($founditem->sortByDesc('created_at')->take(5) as $items)
                                                            <tr>
                                                                <td class="ps-4">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar avatar-sm bg-label-success me-3 rounded p-1">
                                                                            <i class='bx bx-box'></i>
                                                                        </div>
                                                                        <span class="fw-semibold text-dark">{{ $items->namabarang }}</span>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $items->created_at->format('d M Y') }}</td>
                                                                <td>
                                                                    <span class="badge bg-label-info">{{ $items->kategori->nama }}</span>
                                                                </td>
                                                                <td class="text-end pe-4">
                                                                    <a class="btn btn-sm btn-label-primary rounded-pill" href="{{ route('edit-item',$items->id) }}">
                                                                        Detail
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer bg-white border-top text-center py-3">
                                                    <a href="{{ route('items') }}" class="btn btn-primary btn-sm rounded-pill">Lihat Semua Barang Temuan</a>
                                                </div>
                                            </div>

                                        </div>
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
                "emptyTable": "Tidak ada data yang tersedia di tabel",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            };

            $('#foundItemsTable').DataTable({
                "language": indonesianLanguage
            });

            var table = $('#itemsTable').DataTable({
                "language": indonesianLanguage,
            });

            $('#itemsTable .filters th').each(function(i) {
                var th = $(this);
                var filterControl = $(this).find('input, select');

                if (filterControl.length > 0) {
                    if (filterControl.is('input')) {
                        filterControl.on('keyup change', function() {
                            if (table.column(i).search() !== this.value) {
                                table
                                    .column(i)
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    } else if (filterControl.is('select')) {
                        filterControl.on('change', function() {
                            var val = $(this).val();
                            var searchVal = val ? '^' + val + '$' : '';
                            table
                                .column(i)
                                .search(searchVal, true, false)
                                .draw();
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>