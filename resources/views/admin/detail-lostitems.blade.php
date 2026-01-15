<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        Detail Lost Items
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
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- menu --}}

            @include('layouts.menu-admin')
            {{-- end menu --}}

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
                    @include ('layouts.navbar')
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold m-0 text-primary">
                                <span class="text-muted fw-light">Data Aduan /</span> Detail #{{ $collection->id }}
                            </h4>
                            <a href="{{ route('lostitems') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class='bx bx-arrow-back me-1'></i> Kembali
                            </a>
                        </div>

                        <div class="row g-4">
                            {{-- LEFT COLUMN: IMAGES --}}
                            <div class="col-lg-5">
                                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden position-relative bg-light">
                                    <div class="card-header bg-transparent border-bottom-0 pb-0">
                                        <h5 class="fw-bold mb-0">Foto Barang</h5>
                                    </div>
                                    <div class="card-body p-0 d-flex align-items-center justify-content-center" style="min-height: 400px;">
                                        @if($collection->images && $collection->images->count() > 0)
                                            <div id="aduanCarousel" class="carousel slide w-100 h-100" data-bs-ride="carousel">
                                                <div class="carousel-inner h-100">
                                                    @foreach($collection->images as $key => $image)
                                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100 text-center">
                                                            <div class="d-flex align-items-center justify-content-center h-100 bg-light p-3">
                                                                <img src="{{ Storage::url('public/assets/img/aduan/' . $image->image_path) }}"
                                                                     class="img-fluid rounded shadow-sm" alt="Foto Barang"
                                                                     style="max-height: 350px; object-fit: contain; cursor: zoom-in;"
                                                                     onclick="openZoomModal(this.src)">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if($collection->images->count() > 1)
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#aduanCarousel" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true" style="background-size: 50%;"></span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#aduanCarousel" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true" style="background-size: 50%;"></span>
                                                    </button>
                                                @endif
                                            </div>
                                        @else
                                            <div class="p-4 w-100 h-100 d-flex align-items-center justify-content-center">
                                                <img src="{{ Storage::url('public/assets/img/aduan/' . $collection->foto) }}"
                                                     alt="Foto Barang" class="img-fluid rounded shadow-sm"
                                                     style="max-height: 350px; object-fit: contain; cursor: zoom-in;"
                                                     onclick="openZoomModal(this.src)">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-footer bg-transparent border-top-0 text-center pb-4">
                                        <small class="text-muted"><i class='bx bx-zoom-in'></i> Klik gambar untuk memperbesar</small>
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT COLUMN: DETAILS --}}
                            <div class="col-lg-7">
                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                    <div class="card-header bg-white border-bottom-0 py-4 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="fw-bold mb-1">Informasi Laporan</h5>
                                            <small class="text-muted">Diajukan pada {{ \Carbon\Carbon::parse($collection->created_at)->translatedFormat('d F Y, H:i') }}</small>
                                        </div>
                                        <div>
                                            @if ($collection->status == '1')
                                                <span class="badge bg-success rounded-pill px-3 py-2 fs-6">Diterima</span>
                                            @elseif ($collection->status == '2')
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning rounded-pill px-3 py-2 fs-6 text-dark">Menunggu Konfirmasi</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control bg-light border-0 fw-bold" id="namaUser" value="{{ $collection->user->name ?? 'User Tidak Dikenal' }}" readonly>
                                                    <label for="namaUser">Nama Pelapor</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control bg-light border-0" id="emailUser" value="{{ $collection->user->email ?? '-' }}" readonly>
                                                    <label for="emailUser">Email Pelapor</label>
                                                </div>
                                            </div>

                                            <div class="col-12"><hr class="text-muted my-1"></div>

                                            <div class="col-md-7">
                                                <label class="form-label small text-uppercase text-muted fw-bold">Nama Barang</label>
                                                <p class="fs-5 fw-bold text-dark mb-0">{{ $collection->namabarang }}</p>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label small text-uppercase text-muted fw-bold">Kategori</label>
                                                <p class="fs-5 fw-semibold text-dark mb-0">{{ $collection->kategori->nama }}</p>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small text-uppercase text-muted fw-bold">Deskripsi</label>
                                                <div class="p-3 bg-light rounded-3">
                                                    <p class="mb-0 text-dark" style="white-space: pre-line;">{{ $collection->deskripsi }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="p-3 border rounded-3 h-100">
                                                    <label class="form-label small text-muted mb-1"><i class='bx bx-calendar'></i> Tanggal Hilang</label>
                                                    <p class="fw-semibold mb-0">{{ \Carbon\Carbon::parse($collection->tglketinggalan)->translatedFormat('d F Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="p-3 border rounded-3 h-100">
                                                    <label class="form-label small text-muted mb-1"><i class='bx bx-map'></i> Lokasi</label>
                                                    <p class="fw-semibold mb-0">{{ $collection->stasiun->nama }} <span class="text-muted fw-normal">({{ $collection->area->nama }})</span></p>
                                                </div>
                                            </div>

                                            @if($collection->keteranganlain)
                                            <div class="col-12">
                                                <div class="alert alert-secondary border-0 d-flex align-items-center mb-0">
                                                    <i class='bx bx-info-circle me-3 fs-4'></i>
                                                    <div>
                                                        <small class="fw-bold d-block text-uppercase">Keterangan Lain</small>
                                                        <span>{{ $collection->keteranganlain }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-12">
                                                <div class="p-3 border rounded-3 h-100" style="{{ $collection->kode_booking ? 'background-color: #e7f1ff; border-color: #b3d7ff !important;' : 'background-color: #f8f9fa;' }}">
                                                    <label class="form-label small text-uppercase text-muted fw-bold mb-1"><i class='bx bx-receipt text-primary me-1'></i> Kode Booking</label>
                                                    <p class="fs-5 fw-bold {{ $collection->kode_booking ? 'text-primary' : 'text-muted' }} mb-0" style="letter-spacing: 1px;">
                                                        {{ $collection->kode_booking ?? 'Tidak ada kode booking' }}
                                                    </p>
                                                    @if($collection->kode_booking)
                                                        <small class="text-muted"><i class='bx bx-train'></i> Perjalanan via KAI/KRL</small>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            {{-- REJECTION REASON DISPLAY IF REJECTED --}}
                                            @if($collection->status == '2' && $collection->alasan_penolakan)
                                            <div class="col-12">
                                                <div class="alert alert-danger border-0 d-flex align-items-start mb-0">
                                                    <i class='bx bx-x-circle me-3 fs-4 mt-1'></i>
                                                    <div>
                                                        <small class="fw-bold d-block text-uppercase">Alasan Penolakan</small>
                                                        <span>{{ $collection->alasan_penolakan }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                    
                                    {{-- ACTION BUTTONS --}}
                                    @if ($collection->status == 0)
                                    <div class="card-footer bg-white border-top-0 pt-0 pb-4">
                                        <hr class="mb-4">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" class="btn btn-outline-danger btn-lg rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tolakModal">
                                                <i class='bx bx-x me-1'></i> Tolak
                                            </button>
                                            
                                            <form method="POST" action="{{ route('konfirmasi-aduan') }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="{{ $collection->id }}">
                                                <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm fw-bold">
                                                    <i class='bx bx-check me-1'></i> Terima Aduan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- MODAL ZOOM GAMBAR --}}
                        <div class="modal fade" id="zoomModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-transparent border-0 shadow-none">
                                    <div class="modal-body text-center p-0">
                                        <img id="zoomedImage" src="" class="img-fluid rounded shadow-lg" style="max-height: 90vh;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL TOLAK --}}
                        <div class="modal fade" id="tolakModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header bg-danger text-white rounded-top-4">
                                        <h5 class="modal-title text-white fw-bold"><i class='bx bx-message-alt-x me-2'></i>Tolak Aduan</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('tolak-aduan') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="id" value="{{ $collection->id }}">
                                            <div class="mb-3">
                                                <label for="alasan_penolakan" class="form-label fw-bold">Alasan Penolakan</label>
                                                <textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan" rows="4" required placeholder="Jelaskan kepada user kenapa laporan ini ditolak..."></textarea>
                                                <small class="text-muted">Pesan ini akan muncul di dashboard user.</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light rounded-bottom-4 border-top-0">
                                            <button type="button" class="btn btn-link text-secondary text-decoration-none fw-bold" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Kirim Penolakan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            function openZoomModal(src) {
                                var modal = new bootstrap.Modal(document.getElementById('zoomModal'));
                                document.getElementById('zoomedImage').src = src;
                                modal.show();
                            }
                        </script>
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