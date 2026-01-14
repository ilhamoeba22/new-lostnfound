<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width,  nitial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

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
                                <span class="text-muted fw-light">Data Barang /</span> Tambah Barang Baru
                            </h4>
                            <a href="{{ route('items') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class='bx bx-arrow-back me-1'></i> Kembali
                            </a>
                        </div>

                        <form action="{{ route('tambahitems') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <!-- Left Column: Image Upload -->
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <div class="card-header bg-white py-3">
                                            <h6 class="fw-bold mb-0 text-dark">Foto Barang</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <div id="preview-container" class="d-flex flex-wrap justify-content-center gap-2">
                                                    <img id="placeholder-preview" src="{{ asset('assets/img/default.png') }}"
                                                        class="img-fluid rounded-3 border" style="width: 100%; height: 250px; object-fit: cover;" alt="Placeholder">
                                                </div>
                                            </div>
                                            
                                            <div class="d-grid gap-2">
                                                <label for="upload" class="btn btn-primary rounded-pill shadow-sm" tabindex="0">
                                                    <i class="bx bx-upload me-1"></i> Pilih Foto (Max 3)
                                                    <input type="file" name="foto[]" id="upload" class="account-file-input" hidden multiple accept="image/png, image/jpeg, image/jpg" />
                                                </label>
                                                <button type="button" class="btn btn-outline-danger rounded-pill shadow-sm" id="resetImage">
                                                    <i class="bx bx-reset me-1"></i> Reset Foto
                                                </button>
                                            </div>
                                            <p class="text-muted small mt-3 mb-0">Format: JPG, PNG. Max: 2MB.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Form Details -->
                                <div class="col-md-8">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <div class="card-header bg-white py-3">
                                            <h6 class="fw-bold mb-0 text-dark">Informasi Barang</h6>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <!-- Nama Barang -->
                                                <div class="col-md-12">
                                                    <label for="namabarang" class="form-label fw-semibold small text-uppercase text-muted">Nama Barang</label>
                                                    <input required class="form-control form-control-lg bg-light border-0" type="text" 
                                                        id="namabarang" name="namabarang" placeholder="Contoh: Dompet Kulit Coklat" autofocus />
                                                </div>

                                                <!-- Kategori & Deskripsi -->
                                                <div class="col-md-6">
                                                    <label for="kategori_id" class="form-label fw-semibold small text-uppercase text-muted d-flex align-items-center">
                                                        Kategori
                                                        <i class="bx bx-info-circle ms-1 text-primary" data-bs-toggle="tooltip" title="Pilih kategori yang sesuai untuk pencocokan otomatis"></i>
                                                    </label>
                                                    <select required class="form-select form-select-lg bg-light border-0" name="kategori_id" id="kategori_id">
                                                        <option selected disabled value="">Pilih Kategori</option>
                                                        @foreach ($kategoris as $kategori)
                                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="deskripsi" class="form-label fw-semibold small text-uppercase text-muted">Deskripsi Barang</label>
                                                    <textarea required class="form-control bg-light border-0" name="deskripsi" id="deskripsi" rows="3"
                                                        placeholder="Jelaskan ciri-ciri fisik barang..."></textarea>
                                                </div>

                                                <!-- Lokasi & Waktu Group -->
                                                <div class="col-12 mt-4">
                                                    <div class="p-3 border rounded-3 bg-light-subtle">
                                                        <h6 class="fw-bold text-primary mb-3"><i class='bx bx-map-pin me-1'></i> Lokasi & Waktu Ditemukan</h6>
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <label for="tglditemukan" class="form-label fw-semibold small text-uppercase text-muted">Tanggal</label>
                                                                <input required class="form-control border-0 bg-white" name="tglditemukan" type="date" id="tglditemukan">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="stasiun_id" class="form-label fw-semibold small text-uppercase text-muted">Stasiun</label>
                                                                <select required class="form-select border-0 bg-white" name="stasiun_id" id="stasiun_id">
                                                                    <option selected disabled value="">Pilih Stasiun</option>
                                                                    @foreach ($stasiuns as $stasiun)
                                                                        <option value="{{ $stasiun->id }}">{{ $stasiun->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="area_id" class="form-label fw-semibold small text-uppercase text-muted">Area</label>
                                                                <select required class="form-select border-0 bg-white" name="area_id" id="area_id">
                                                                    <option selected disabled value="">Pilih Area</option>
                                                                    @foreach ($areas as $area)
                                                                        <option value="{{ $area->id }}">{{ $area->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2 mt-4">
                                                <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">Batal</button>
                                                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                                    <i class='bx bx-save me-1'></i> Simpan Data Barang
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Zoom Modal -->
                        <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                    <img id="zoomedImage" src="" class="img-fluid rounded shadow-lg" style="max-height: 80vh;" />
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
    <!-- build:js {{ asset('assets') }}/vendor/js/core.js -->
    <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('assets') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets') }}/js/pages-account-settings-account.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
        });
    </script>
    @push('scripts')
    <script>
        const uploadInput = document.getElementById('upload');
        const previewContainer = document.getElementById('preview-container');
        const placeholderPreview = document.getElementById('placeholder-preview');
        const resetBtn = document.getElementById('resetImage');
        const zoomedImage = document.getElementById('zoomedImage');
        const imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));

        // Function to open zoom modal
        window.openZoomModal = function(src) {
            zoomedImage.src = src;
            imagePreviewModal.show();
        }

        uploadInput.addEventListener('change', function(event) {
            const files = event.target.files;
            
            // Validation: Max 3 files
            if (files.length > 3) {
                alert('Maksimal upload 3 foto.');
                uploadInput.value = ''; // Clear input
                previewContainer.innerHTML = ''; // Clear previews
                previewContainer.appendChild(placeholderPreview); // Restore placeholder
                return;
            }

            // Clear previous previews
            previewContainer.innerHTML = '';

            if (files.length === 0) {
                 previewContainer.appendChild(placeholderPreview);
                 return;
            }

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('d-block', 'rounded', 'border');
                    img.style.width = '150px';
                    img.style.height = '150px';
                    img.style.objectFit = 'cover';
                    img.style.cursor = 'zoom-in';
                    img.onclick = function() {
                        openZoomModal(this.src);
                    };
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });

        resetBtn.addEventListener('click', () => {
            uploadInput.value = '';
            previewContainer.innerHTML = '';
            previewContainer.appendChild(placeholderPreview);
        });
    </script>

</body>

</html>