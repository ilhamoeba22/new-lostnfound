<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width,  nitial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

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


                        <div class="row">

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="card border-0 shadow-sm rounded-4">
                                    <div class="card-header bg-transparent py-4 border-bottom-0 d-flex justify-content-between align-items-center">
                                        <h4 class="fw-bold mb-0 text-primary">
                                            <i class='bx bx-file-find me-2'></i> Detail Aduan #{{ $aduan->id }}
                                        </h4>
                                        <div>
                                            @if ($aduan->status == '0')
                                                <span class="badge bg-warning rounded-pill px-3 py-2">
                                                    <i class='bx bx-time-five me-1'></i> Diproses
                                                </span>
                                            @elseif ($aduan->status == '1')
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class='bx bx-check-circle me-1'></i> Diterima
                                                </span>
                                            @elseif ($aduan->status == '2')
                                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                                    <i class='bx bx-x-circle me-1'></i> Ditolak
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="card-body px-4 pb-5">
                                        {{-- STATUS ALERTS --}}
                                        @if ($aduan->status =='0' )
                                        <div class="alert alert-soft-warning border-0 rounded-3 mb-4 d-flex align-items-center" role="alert">
                                            <i class='bx bx-loader-alt bx-spin me-3 fs-3 text-warning'></i>
                                            <div>
                                                <h6 class="alert-heading fw-bold mb-1 text-warning">Aduan sedang ditinjau</h6>
                                                <p class="mb-0 text-secondary small">
                                                    Mohon menunggu validasi dari admin. Kami akan memberitahu Anda segera.
                                                </p>
                                            </div>
                                        </div>
                                        @elseif ($aduan->status == '2')
                                        <div class="alert alert-soft-danger border-0 rounded-3 mb-4" role="alert">
                                            <div class="d-flex align-items-start">
                                                <i class='bx bx-error-circle me-3 fs-3 text-danger'></i>
                                                <div>
                                                    <h6 class="alert-heading fw-bold mb-1 text-danger">Aduan Ditolak</h6>
                                                    @if($aduan->alasan_penolakan)
                                                        <p class="mb-0 text-secondary small mt-1">
                                                            <strong>Alasan:</strong> {{ $aduan->alasan_penolakan }}
                                                        </p>
                                                    @else
                                                        <p class="mb-0 text-secondary small">Maaf, laporan Anda tidak dapat kami proses saat ini.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @elseif ($aduan->status =='1' )
                                        <div class="alert alert-soft-success border-0 rounded-3 mb-4 d-flex align-items-center" role="alert">
                                            <i class='bx bx-check-shield me-3 fs-3 text-success'></i>
                                            <div>
                                                <h6 class="alert-heading fw-bold mb-1 text-success">Laporan Diterima!</h6>
                                                <p class="mb-0 text-secondary small">
                                                    Kami menemukan barang yang mungkin sesuai dengan laporan Anda. Cek daftar di bawah.
                                                </p>
                                            </div>
                                        </div>
                                        @endif

                                        {{-- MAIN CONTENT SPLIT --}}
                                        <div class="row g-4">
                                            {{-- LEFT: IMAGES --}}
                                            <div class="col-lg-5">
                                                <div class="card border-0 bg-light rounded-4 h-100 overflow-hidden position-relative">
                                                    @if($aduan->images && $aduan->images->count() > 0)
                                                        <div id="aduanCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                                                            <div class="carousel-inner h-100 d-flex align-items-center bg-light">
                                                                @foreach($aduan->images as $key => $image)
                                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100">
                                                                        <img src="{{ Storage::url('public/assets/img/aduan/').$image->image_path }}"
                                                                            class="d-block w-100 h-100" alt="Foto Barang" 
                                                                            style="object-fit: contain; min-height: 300px; max-height: 400px;"
                                                                            onclick="openZoomModal(this.src)" role="button">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @if($aduan->images->count() > 1)
                                                                <button class="carousel-control-prev" type="button" data-bs-target="#aduanCarousel" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true" style="background-size: 50%;"></span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#aduanCarousel" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true" style="background-size: 50%;"></span>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="d-flex align-items-center justify-content-center h-100 bg-light" style="min-height: 300px;">
                                                            <img src="{{ Storage::url('public/assets/img/aduan/').$aduan->foto }}"
                                                                alt="Foto Barang" class="img-fluid rounded shadow-sm"
                                                                style="max-height: 300px; object-fit: contain;"
                                                                onclick="openZoomModal(this.src)" role="button" />
                                                        </div>
                                                    @endif
                                                    <p class="text-center mt-2 small text-muted fst-italic"><i class='bx bx-search-alt'></i> Klik gambar untuk memperbesar</p>
                                                </div>
                                            </div>

                                            {{-- RIGHT: DETAILS --}}
                                            <div class="col-lg-7">
                                                <div class="row g-4">
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light rounded-3 h-100">
                                                            <label class="small text-muted text-uppercase fw-bold mb-1">Nama Barang</label>
                                                            <p class="fs-5 fw-semibold text-dark mb-0">{{ $aduan->namabarang }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light rounded-3 h-100">
                                                            <label class="small text-muted text-uppercase fw-bold mb-1">Kategori</label>
                                                            <p class="fs-5 fw-semibold text-dark mb-0">{{ $aduan->kategori?->nama ?? '-' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="p-3 bg-light rounded-3 h-100">
                                                            <label class="small text-muted text-uppercase fw-bold mb-1">Deskripsi</label>
                                                            <p class="text-dark mb-0" style="line-height: 1.6;">{{ $aduan->deskripsi }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light rounded-3 h-100">
                                                            <label class="small text-muted text-uppercase fw-bold mb-1">Tanggal Hilang</label>
                                                            <p class="fs-6 fw-semibold text-dark mb-0">
                                                                <i class='bx bx-calendar me-2 text-primary'></i> {{ \Carbon\Carbon::parse($aduan->tglketinggalan)->translatedFormat('d F Y') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light rounded-3 h-100">
                                                            <label class="small text-muted text-uppercase fw-bold mb-1">Lokasi</label>
                                                            <p class="fs-6 fw-semibold text-dark mb-0">
                                                                <i class='bx bx-map me-2 text-danger'></i> Stasiun {{ $aduan->stasiun?->nama ?? '-' }}
                                                            </p>
                                                            <small class="text-muted ps-4">{{ $aduan->area?->nama ?? '' }}</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="p-3 bg-light rounded-3 h-100 border {{ $aduan->kode_booking ? 'border-primary border-opacity-25' : '' }}" style="{{ $aduan->kode_booking ? 'background-color: #f0f7ff !important;' : '' }}">
                                                            <label class="small text-muted text-uppercase fw-bold mb-1"><i class='bx bx-receipt text-primary me-1'></i> Kode Booking KAI</label>
                                                            <p class="fs-5 fw-bold {{ $aduan->kode_booking ? 'text-primary' : 'text-muted' }} mb-0" style="letter-spacing: 1px;">
                                                                {{ $aduan->kode_booking ?? 'Tidak ada kode booking' }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    @if($aduan->keteranganlain)
                                                    <div class="col-12">
                                                        <div class="p-3 border border-dashed rounded-3">
                                                            <label class="small text-muted text-uppercase fw-bold mb-1">Info Tambahan</label>
                                                            <p class="text-secondary mb-0 small fst-italic">"{{ $aduan->keteranganlain }}"</p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MATCHING ITEMS SECTION --}}
                        @if ($aduan->status =='1' )
                        <div class="row mt-5">
                            <div class="col-12 mb-4 text-center">
                                <h3 class="fw-bold text-primary">Barang Temuan Yang Cocok</h3>
                                <p class="text-muted">Berikut adalah barang yang mungkin adalah milik Anda.</p>
                            </div>
                            
                            @foreach ($items as $item )
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden hover-card">
                                    <div class="position-relative">
                                        <img class="card-img-top object-fit-cover" style="height:220px"
                                            src="{{ Storage::url('public/assets/img/items/').$item->foto }}"
                                            alt="Item Image">
                                        <div class="badge bg-white text-dark position-absolute top-0 end-0 m-3 shadow-sm rounded-pill px-3 py-1 fw-bold">
                                            #{{ $item->id }}
                                        </div>
                                    </div>
                                    <div class="card-body p-4 d-flex flex-column">
                                        <h5 class="card-title fw-bold text-truncate mb-1">{{ $item->namabarang }}</h5>
                                        <p class="text-muted small mb-3">{{ $item->kategori?->nama ?? 'Umum' }}</p>
                                        
                                        <div class="mb-4 small">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class='bx bx-map-pin me-2 text-secondary'></i>
                                                <span class="text-truncate">{{ $item->stasiun?->nama ?? 'N/A' }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-time me-2 text-secondary'></i>
                                                <span>{{ \Carbon\Carbon::parse($item->tglditemukan)->translatedFormat('d M Y') }}</span>
                                            </div>
                                        </div>

                                        <form action="{{ route('claimaduan') }}" method="POST" class="mt-auto">
                                            @csrf
                                            <input type="hidden" name="aduan_id" value="{{ $aduan->id }}">
                                            <input type="hidden" name="barang_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold shadow-sm section-btn">
                                                <i class='bx bx-check-double me-1'></i> Klaim Ini
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Modal Zoom Image --}}
                        <div class="modal fade" id="zoomModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-transparent border-0 shadow-none">
                                    <div class="modal-body text-center p-0">
                                        <img id="zoomedImage" src="" class="img-fluid rounded shadow-lg" style="max-height: 90vh;">
                                    </div>
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

                        <style>
                            .alert-soft-warning { background-color: #fff3cd; border-color: #ffeeba; }
                            .alert-soft-danger { background-color: #f8d7da; border-color: #f5c6cb; }
                            .alert-soft-success { background-color: #d1e7dd; border-color: #badbcc; }
                            .hover-card:hover { transform: translateY(-5px); transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
                            .section-btn:hover { transform: scale(1.02); }
                        </style>
                        {{-- end form aduan --}}

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
</body>

</html>