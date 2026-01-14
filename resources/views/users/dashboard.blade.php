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

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            @include('layouts.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    @include('layouts.navbar')
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        
                        <!-- Welcome Header -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card bg-primary text-white overflow-hidden border-0 shadow-sm rounded-4 position-relative">
                                    <div class="card-body p-4 p-md-5">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="z-1">
                                                <h2 class="text-white fw-bold mb-2">Selamat Datang, {{ auth::user()->name }}! 👋</h2>
                                                <p class="mb-0 opacity-75 fs-6">Senang melihatmu kembali. Pantau laporan kehilangan dan temuan barangmu di sini.</p>
                                            </div>
                                            <div class="d-none d-md-block position-absolute end-0 bottom-0 me-4 mb-3">
                                                <i class='bx bx-party' style="font-size: 8rem; opacity: 0.2;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content Grid -->
                        <div class="row g-4">
                            <!-- Left: Profile Card -->
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3 position-relative d-inline-block">
                                            <img src="{{ 'https://ui-avatars.com/api/?name='.urlencode(auth::user()->name).'&background=377DFF&color=fff&size=128' }}" 
                                                 alt="user-avatar" class="rounded-circle shadow-sm border border-4 border-white" width="100" height="100">
                                            <span class="position-absolute bottom-0 end-0 p-2 bg-success border border-white rounded-circle">
                                                <span class="visually-hidden">Online</span>
                                            </span>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-1">{{ auth::user()->name }}</h5>
                                        <p class="text-muted small mb-3">{{ auth::user()->email }}</p>
                                        <div class="d-flex justify-content-center gap-2 mb-4">
                                            <span class="badge bg-label-primary rounded-pill px-3">User</span>
                                            <span class="badge bg-label-success rounded-pill px-3">Verified</span>
                                        </div>

                                        <hr class="my-4">

                                        <!-- Profile Form (Simplified) -->
                                        <div class="text-start">
                                            <h6 class="text-uppercase text-muted small fw-bold mb-3">Informasi Akun</h6>
                                            <form method="post" action="{{ route('profile.update') }}">
                                                @csrf
                                                @method('patch')
                                                <div class="mb-3">
                                                    <label class="form-label small">Nama Lengkap</label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small">Nomor Telepon</label>
                                                    <input type="text" name="phonenumber" class="form-control" value="{{ old('phonenumber', $user->phonenumber) }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100 rounded-pill">Simpan Perubahan</button>
                                            </form>
                                            
                                            @if (session('status') === 'profile-updated')
                                                <div class="alert alert-success mt-3 mb-0 py-2 small" role="alert">
                                                    <i class='bx bx-check-circle me-1'></i> Profil berhasil diperbarui!
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Statistics & Activities -->
                            <div class="col-md-8">
                                
                                <!-- Quick Stats -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="card border-0 shadow-sm rounded-4 bg-label-primary">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="avatar avatar-md bg-white rounded-3 p-2 me-3">
                                                    <i class='bx bx-file text-primary fs-3'></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block fw-bold display-6" style="line-height: 1.2;">{{ $aduans ? $aduans->count() : 0 }}</small>
                                                    <span class="small text-primary fw-semibold">Total Laporan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-0 shadow-sm rounded-4 bg-label-warning">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="avatar avatar-md bg-white rounded-3 p-2 me-3">
                                                    <i class='bx bx-loader-alt text-warning fs-3'></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block fw-bold display-6" style="line-height: 1.2;">
                                                        {{ $aduans ? $aduans->where('status', '0')->count() : 0 }}
                                                    </small>
                                                    <span class="small text-warning fw-semibold">Sedang Diproses</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-0 shadow-sm rounded-4 bg-label-success">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="avatar avatar-md bg-white rounded-3 p-2 me-3">
                                                    <i class='bx bx-check-circle text-success fs-3'></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block fw-bold display-6" style="line-height: 1.2;">
                                                        {{ $aduans ? $aduans->where('status', '1')->count() : 0 }}
                                                    </small>
                                                    <span class="small text-success fw-semibold">Selesai/Ditemukan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Activities -->
                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                                        <h5 class="fw-bold m-0 text-dark"><i class='bx bx-time-five me-2 text-primary'></i>Aktivitas Terkini</h5>
                                        <a href="{{ route('bikinaduan') }}" class="btn btn-primary btn-sm rounded-pill">
                                            <i class='bx bx-plus me-1'></i> Buat Laporan Baru
                                        </a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group list-group-flush rounded-bottom-4">
                                            @if ($aduans && $aduans->count() > 0)
                                                @foreach ($aduans as $aduan)
                                                    <div class="list-group-item p-3 border-bottom-0 border-top">
                                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar bg-light rounded p-2 me-3 d-flex align-items-center justify-content-center">
                                                                    <i class='bx {{ $aduan->status == "1" ? "bx-check text-success" : ($aduan->status == "2" ? "bx-x text-danger" : "bx-loader-alt text-warning") }} fs-4'></i>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-1 fw-bold text-dark">Laporan ID #{{ $aduan->id }}</h6>
                                                                    <p class="mb-0 text-muted small">
                                                                        {{-- Placeholder for date if not available in this view's query, relying on ID or generic text for now --}}
                                                                        Laporan barang hilang anda.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="text-end">
                                                                @if ($aduan->status == '0')
                                                                    <span class="badge bg-label-warning rounded-pill">Sedang Diproses</span>
                                                                @elseif ($aduan->status == '1')
                                                                    <span class="badge bg-label-success rounded-pill">Ditemukan</span>
                                                                @else
                                                                    <span class="badge bg-label-danger rounded-pill">Ditolak</span>
                                                                @endif
                                                                <a href="{{ route('detailaduan', $aduan->id) }}" class="btn btn-icon btn-sm btn-label-secondary ms-2 rounded-circle">
                                                                    <i class='bx bx-chevron-right'></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center p-5">
                                                    <img src="{{ asset('assets/img/illustrations/girl-doing-yoga-light.png') }}" alt="No Data" width="150" class="mb-3">
                                                    <h6 class="text-muted fw-bold">Belum ada aktivitas</h6>
                                                    <p class="text-muted small">Mulai dengan membuat laporan kehilangan barang.</p>
                                                    <a href="{{ route('bikinaduan') }}" class="btn btn-outline-primary btn-sm rounded-pill mt-2">Buat Laporan Sekarang</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('layouts.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>