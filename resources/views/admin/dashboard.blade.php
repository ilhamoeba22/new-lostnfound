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
                        <div class="row">
                            <div class="col-12 col-md-8 col-lg-12">
                                <div class="row">
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">

                                                <span class="d-block mb-1">TOTAL ADUAN</span>
                                                <h3 class="card-title text-danger text-nowrap mb-2">{{$lostitem}}</h3>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">

                                                <span class="d-block mb-1">TOTAL BARANG DITEMUKAN</span>
                                                <h3 class="card-title text-success  text-nowrap mb-2">
                                                    {{$founditem->count()}}
                                                </h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- @include('profile.partials.update-profile-information-form') --}}

                            <div class="col-md-12 col-lg-12 order-1 mb-4">
                                <h6 class="text-muted">Laporan</h6>

                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="tab-items" data-bs-toggle="tab"
                                                data-bs-target="#navs-top-items" type="button" role="tab">
                                                Barang Hilang (Aduan)
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="tab-lost" data-bs-toggle="tab"
                                                data-bs-target="#navs-top-lost" type="button" role="tab">
                                                Barang Ditemukan
                                            </button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-3" id="dashboardTabsContent">

                                        <div class="tab-pane fade show active" id="navs-top-items" role="tabpanel">
                                            <div class="table-responsive">
                                                <table id="itemsTable"
                                                    class="table table-bordered table-striped align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>ID Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Tanggal</th>
                                                            <th>Stasiun</th>
                                                            <th>Kategori</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        <tr class="filters">
                                                            <th><input type="text"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Cari ID" /></th>
                                                            <th><input type="text"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Cari Nama" /></th>
                                                            <th><input type="text"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Cari Tanggal" /></th>
                                                            <th>
                                                                <select class="form-select form-select-sm">
                                                                    <option value="">Semua Stasiun</option>
                                                                    @foreach($stasiuns as $stasiun)
                                                                    <option value="{{ $stasiun->nama }}">{{
                                                                        $stasiun->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </th>
                                                            <th><input type="text"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Cari Kategori" /></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="table-border-bottom-0">
                                                        @foreach($aduan as $items)
                                                        <tr>
                                                            <td><strong>{{ $items->id }}</strong></td>
                                                            <td>{{ $items->namabarang }}</td>
                                                            <td>{{ $items->created_at->format('Y-m-d') }}</td>
                                                            <td>{{ $items->stasiun ? $items->stasiun->nama : '-' }}</td>
                                                            <td>{{ $items->kategori->nama }}</td>
                                                            <td>
                                                                <a class="btn btn-sm btn-primary"
                                                                    href="{{ route('detaillostitems', ['id' => $items->id]) }}">
                                                                    <i class="bx bx-envelope-open me-1"></i> Lihat
                                                                    Detail
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="navs-top-lost" role="tabpanel">
                                            <div class="table-responsive">
                                                <table id="foundItemsTable"
                                                    class="table table-bordered table-striped align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Nama Barang</th>
                                                            <th>Tanggal</th>
                                                            <th>Kategori</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @foreach($founditem as $items)
                                                        <tr>
                                                            <td>{{ $items->namabarang }}</td>
                                                            <td>{{ $items->created_at->format('Y-m-d') }}</td>
                                                            <td>
                                                                <span class="badge bg-success">{{
                                                                    $items->kategori->nama }}</span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm btn-primary"
                                                                    href="{{ route('detaillostitems', ['id' => $items->id]) }}">
                                                                    <i class="bx bx-envelope-open me-1"></i> Lihat
                                                                    Detail
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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