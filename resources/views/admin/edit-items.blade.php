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
                                <span class="text-muted fw-light">Data Barang /</span> Edit Item #{{ $collection->id }}
                            </h4>
                            <a href="{{ route('items') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class='bx bx-arrow-back me-1'></i> Kembali
                            </a>
                        </div>

                        <form action="{{ route('editItems', ['id'=>$collection->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                {{-- LEFT COLUMN: IMAGES --}}
                                <div class="col-lg-5">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                                            <h5 class="fw-bold mb-0">Foto Barang</h5>
                                            <small class="text-muted">Kelola gambar untuk barang ini</small>
                                        </div>
                                        <div class="card-body pt-4">
                                            {{-- Current Images Preview (Carousel/Grid) --}}
                                            <div class="bg-light rounded-4 overflow-hidden mb-4 position-relative d-flex align-items-center justify-content-center" style="min-height: 250px;">
                                                <div id="preview-container" class="d-flex flex-wrap gap-2 justify-content-center p-3 w-100 h-100">
                                                    @if($collection->images && $collection->images->count() > 0)
                                                        @foreach($collection->images as $img)
                                                            <div class="position-relative">
                                                                <img src="{{ Storage::url('public/assets/img/items/').$img->image_path }}"
                                                                     class="rounded-3 shadow-sm old-image"
                                                                     style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;"
                                                                     onclick="openZoomModal(this.src)">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <img src="{{ Storage::url('public/assets/img/items/').$collection->foto }}"
                                                             class="rounded-3 shadow-sm old-image"
                                                             style="width: 100%; height: 250px; object-fit: contain; cursor: pointer;"
                                                             onclick="openZoomModal(this.src)">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <label for="upload" class="btn btn-primary rounded-pill py-2">
                                                    <i class='bx bx-upload me-1'></i> Ganti / Tambah Foto
                                                </label>
                                                <input type="file" name="foto[]" id="upload" hidden multiple accept="image/png, image/jpeg, image/jpg" />
                                                
                                                <button type="button" class="btn btn-light rounded-pill py-2 text-muted" id="resetImage">
                                                    <i class='bx bx-refresh me-1'></i> Reset Pilihan
                                                </button>
                                            </div>
                                            <div class="alert alert-info border-0 bg-light-info text-info mt-3 small mb-0 fs-tiny">
                                                <i class='bx bx-info-circle me-1'></i> Upload foto baru akan <strong>mengganti semua</strong> foto yg ada saat ini (Max 3).
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- RIGHT COLUMN: FORM --}}
                                <div class="col-lg-7">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                                            <h5 class="fw-bold mb-0">Informasi Detail</h5>
                                            <small class="text-muted">Perbarui data barang temuan</small>
                                        </div>
                                        <div class="card-body pt-4">
                                            
                                            <div class="row g-3">
                                                <div class="col-md-7">
                                                    <label class="form-label fw-semibold small text-uppercase text-muted">Nama Barang</label>
                                                    <input type="text" class="form-control form-control-lg bg-light border-0" name="namabarang" value="{{ $collection->namabarang }}" placeholder="Contoh: Dompet Hitam" required />
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label fw-semibold small text-uppercase text-muted">Kategori</label>
                                                    <select class="form-select form-select-lg bg-light border-0" name="kategori_id" required>
                                                        <option disabled>Pilih Kategori</option>
                                                        @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}" {{ ($kategori->id == $collection->kategori_id) ? 'selected' : '' }}>
                                                            {{ $kategori->nama }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-semibold small text-uppercase text-muted">Deskripsi</label>
                                                    <textarea class="form-control bg-light border-0" name="deskripsi" rows="4" placeholder="Jelaskan ciri-ciri barang...">{{ $collection->deskripsi }}</textarea>
                                                </div>

                                                <div class="col-12">
                                                    <div class="p-3 border rounded-3 bg-light-subtle">
                                                        <h6 class="fw-bold mb-3 small text-primary"><i class='bx bx-map-pin me-1'></i> Lokasi & Waktu</h6>
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label small text-muted">Tgl Ditemukan</label>
                                                                <input class="form-control border-0 bg-white" name="tglditemukan" type="date" value="{{ $collection->tglditemukan }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small text-muted">Stasiun</label>
                                                                <select class="form-select border-0 bg-white" name="stasiun_id">
                                                                    @foreach ($stasiuns as $stasiun)
                                                                    <option value="{{ $stasiun->id }}" {{ ($stasiun->id == $collection->stasiun_id) ? 'selected' : '' }}>{{ $stasiun->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small text-muted">Area</label>
                                                                <select class="form-select border-0 bg-white" name="area_id">
                                                                    @foreach ($areas as $area)
                                                                    <option value="{{ $area->id }}" {{ ($area->id == $collection->area_id) ? 'selected' : '' }}>{{ $area->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 d-flex justify-content-end gap-2">
                                                <button type="reset" class="btn btn-light rounded-pill px-4">Batal</button>
                                                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                                                    Simpan Perubahan
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Modal Zoom --}}
                        <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-transparent border-0 shadow-none">
                                    <div class="modal-body text-center p-0">
                                        <img id="modalImage" src="" class="img-fluid rounded shadow-lg" style="max-height: 90vh;">
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
    {{-- SCRIPT PREVIEW + RESET --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadInput = document.getElementById('upload');
            const previewContainer = document.getElementById('preview-container');
            const modalImage = document.getElementById('modalImage');
            const resetButton = document.getElementById('resetImage');
            const imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));

            // Store initial/old HTML content to restore on reset
            const oldContent = previewContainer.innerHTML;

            // Global function for zoom
            window.openZoomModal = function(src) {
                modalImage.src = src;
                imagePreviewModal.show();
            }

            // Saat pilih gambar baru
            uploadInput.addEventListener('change', function(event) {
                const files = event.target.files;

                 if (files.length > 3) {
                    alert('Maksimal upload 3 foto.');
                    uploadInput.value = ''; 
                    previewContainer.innerHTML = oldContent; 
                    return;
                }

                if (files.length > 0) {
                    previewContainer.innerHTML = ''; // Clear old images
                    
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
                             img.onclick = function() { window.openZoomModal(this.src); };
                             previewContainer.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    });
                } else {
                     previewContainer.innerHTML = oldContent;
                }
            });

            // Tombol Reset -> Kembalikan ke gambar lama
            resetButton.addEventListener('click', function() {
                uploadInput.value = "";
                previewContainer.innerHTML = oldContent;
            });
        });
    </script>
</body>

</html>