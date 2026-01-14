<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-{{ asset('assets')
    }}-path="{{ asset('assets') }}/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        Dashboard
    </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets') }}/js/config.js"></script>
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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="fw-bold m-0 text-primary">
                                    <span class="text-muted fw-light">Klaim Barang /</span> Detail Klaim
                                </h4>
                                <small class="text-muted">ID Klaim: #{{ $collection->id }}</small>
                            </div>
                            <a href="{{ route('aduan') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class='bx bx-arrow-back me-1'></i> Kembali
                            </a>
                        </div>

                        <div class="row g-4">
                            <!-- Left Column: Images -->
                            <div class="col-md-5">
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                    <div id="claimImageCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                                        {{-- Prepare Images Collection --}}
                                        @php
                                            $allImages = collect([]);

                                            // 1. Claim Images (Priority)
                                            if($collection->images && $collection->images->isNotEmpty()) {
                                                foreach($collection->images as $img) {
                                                    $allImages->push(asset('storage/assets/img/claim/' . $img->image_path));
                                                }
                                            } elseif ($collection->foto) {
                                                $allImages->push(asset('assets/img/claim/' . $collection->foto));
                                            }

                                            // 2. Barang Images (Found Item)
                                            if($collection->barang) {
                                                if($collection->barang->images && $collection->barang->images->isNotEmpty()) {
                                                    foreach($collection->barang->images as $img) {
                                                        $allImages->push(asset('storage/assets/img/items/' . $img->image_path));
                                                    }
                                                } elseif ($collection->barang->foto) {
                                                    $allImages->push(asset('assets/img/items/' . $collection->barang->foto));
                                                }
                                            }

                                            // 3. Aduan Images (Lost Item - if linked)
                                            if($collection->aduan) {
                                                if($collection->aduan->images && $collection->aduan->images->isNotEmpty()) {
                                                    foreach($collection->aduan->images as $img) {
                                                        $allImages->push(asset('storage/assets/img/aduan/' . $img->image_path));
                                                    }
                                                } elseif ($collection->aduan->foto) {
                                                    $allImages->push(asset('assets/img/aduan/' . $collection->aduan->foto));
                                                }
                                            }
                                            
                                            $allImages = $allImages->unique(); // Avoid duplicates if any
                                        @endphp

                                        <div class="carousel-inner bg-light rounded-4 overflow-hidden" style="height: 500px;">
                                            @if($allImages->isNotEmpty())
                                                @foreach($allImages as $key => $imageSrc)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100">
                                                        <div class="d-flex align-items-center justify-content-center w-100 h-100 bg-light">
                                                            <img src="{{ $imageSrc }}" class="d-block" 
                                                                 style="max-width: 100%; max-height: 100%; object-fit: contain;" 
                                                                 alt="Foto Bukti {{ $key + 1 }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="carousel-item active h-100 d-flex align-items-center justify-content-center bg-secondary text-white">
                                                    <div class="text-center p-5">
                                                        <i class="bx bx-image-alt fs-1 mb-2"></i>
                                                        <p class="mb-0">Tidak ada foto bukti</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        @if($allImages->count() > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#claimImageCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#claimImageCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Details -->
                            <div class="col-md-7">
                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                                        <h5 class="fw-bold m-0 text-dark"><i class='bx bx-file me-2 text-primary'></i>Informasi Klaim</h5>
                                        <!-- Status Badge (Placeholder logic since generic Status column isn't standardized in previous context, check aduan table or claim table) -->
                                        <!-- Assuming simple status based on approved/rejected or verification status if distinct column exists. For now, showing 'Menunggu Verifikasi' style or based on logic -->
                                        <span class="badge bg-label-info rounded-pill px-3">Menunggu Verifikasi Admin</span>
                                    </div>
                                    <div class="card-body p-4">
                                        <!-- User Info -->
                                        <h6 class="fw-bold text-muted text-uppercase small mb-3">Identitas Pengklaim</h6>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label text-muted small mb-1">Nama Lengkap</label>
                                                <p class="fw-semibold fs-6 text-dark mb-0">{{ $collection->nama }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label text-muted small mb-1">Alamat</label>
                                                <p class="fw-semibold fs-6 text-dark mb-0">{{ $collection->alamat }}</p>
                                            </div>
                                        </div>

                                        <!-- Claim Message -->
                                        <h6 class="fw-bold text-muted text-uppercase small mb-3">Pesan / Alasan Klaim</h6>
                                        <div class="p-3 bg-light rounded-3 mb-4 border-start border-4 border-primary">
                                            <p class="mb-0 text-secondary fst-italic">"{{ $collection->catatan }}"</p>
                                        </div>

                                        <!-- Item Info -->
                                        <h6 class="fw-bold text-muted text-uppercase small mb-3">Detail Barang yang Diklaim</h6>
                                        <div class="d-flex align-items-center p-3 border rounded-3 bg-white hover-shadow-sm transition-all">
                                            <div class="avatar avatar-lg me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary"><i class='bx bx-box fs-4'></i></span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-dark fw-bold">Kode Barang: {{ $collection->barang_id }}</h6> <!-- Assuming barang_id is the reference, verify if relation works -->
                                                <small class="text-muted d-block">Stasiun: {{ $collection->barang->stasiun->nama ?? '-' }}</small>
                                            </div>
                                            <!-- QR Code Small -->
                                            <div class="ms-3 text-end">
                                               {!! QrCode::size(120)->generate(Request::url('postclaimdetail/'.$collection->id)); !!}
                                            </div>
                                        </div>

                                        <!-- Alert Info -->
                                        <div class="alert alert-primary d-flex align-items-center mt-4 mb-0 rounded-3" role="alert">
                                            <i class="bx bx-info-circle me-2 fs-4"></i>
                                            <div>
                                                Klaim ini sedang ditinjau. Jika disetujui, Anda akan mendapatkan notifikasi untuk pengambilan barang.
                                            </div>
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


            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->


        <!-- Core JS -->
        <!-- build:js {{ asset('assets') }}/vendor/js/core.js -->
        <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
        <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
        <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
        <script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="{{ asset('assets') }}/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="{{ asset('assets') }}/js/main.js"></script>

        <!-- Page JS -->
        <script src="{{ asset('assets') }}/js/pages-account-settings-account.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>