<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width,  nitial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

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
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">Akun /</span>
                            {{ Auth::user()->name }}
                        </h4>

                        <div class="row">



                            <div class="col-md-12 mb-4">

                                {{-- update --}}
                                {{-- <div class="card">
                                    <h4 class="card-header fw-bold py-3 mb-3">
                                        <span class="text-muted fw-light">ADUAN ID :</span>
                                    </h4>
                                    <div class="card-body">
                                        <div class="mb-2 col-12 mb-0">
                                            <div class="alert alert-warning">
                                                <h6 class="alert-heading fw-bold mb-1">
                                                    Yaa.. Proses kamu masih ada yang belum selesai nih..
                                                </h6>


                                            </div>
                                        </div>
                                    </div>

                                </div> --}}
                                {{-- udpate --}}




                                <div class="col-md-12">
                                    <div class="card mb-4 border-0 shadow-sm rounded-4 overlay-hidden">
                                        <div class="card-header bg-white py-3 border-bottom-0">
                                            <h5 class="fw-bold mb-0 text-dark">Formulir Laporan Kehilangan</h5>
                                            <p class="text-muted small mb-0">Isi detail barang yang hilang berikut ini.</p>
                                        </div>
                                        <hr class="my-0" />
                                        <div class="card-body p-4">
                                            <form action="{{ route('bikinaduan') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row g-4">
                                                    <!-- Section: Informasi Barang -->
                                                    <div class="col-12">
                                                        <h6 class="fw-bold text-primary mb-3"><i class='bx bx-package me-1'></i> Informasi Barang</h6>
                                                        <div class="bg-light p-3 rounded-3">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="namabarang" class="form-label fw-semibold small text-uppercase text-muted">Nama Barang</label>
                                                                    <input required class="form-control form-control-lg border-0 bg-white shadow-sm" type="text" id="namabarang"
                                                                        name="namabarang" placeholder="Contoh: Laptop Asus ROG" autofocus value="{{ old('namabarang') }}" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="kategori_id" class="form-label fw-semibold small text-uppercase text-muted d-flex align-items-center">
                                                                        Kategori
                                                                        <i class="bx bx-info-circle ms-1 text-primary" data-bs-toggle="tooltip" title="Pilih kategori yang paling sesuai"></i>
                                                                    </label>
                                                                    <select required class="form-select form-select-lg border-0 bg-white shadow-sm" name="kategori_id" id="kategori_id">
                                                                        <option selected disabled value="">Pilih Kategori Barang</option>
                                                                        @foreach ($kategoris as $kategori)
                                                                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-12">
                                                                    <label class="form-label fw-semibold small text-uppercase text-muted" for="deskripsi">Deskripsi Detail</label>
                                                                    <textarea required class="form-control border-0 bg-white shadow-sm" name="deskripsi" id="deskripsi" rows="3"
                                                                        placeholder="Jelaskan ciri-ciri khusus (warna, merk, goresan, stiker, isi, dll)...">{{ old('deskripsi') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Section: Lokasi & Waktu -->
                                                    <div class="col-12">
                                                        <h6 class="fw-bold text-primary mb-3 mt-2"><i class='bx bx-map-pin me-1'></i> Lokasi & Waktu</h6>
                                                        <div class="bg-light p-3 rounded-3">
                                                            <div class="row g-3">
                                                                <div class="col-md-4">
                                                                    <label for="tglketinggalan" class="form-label fw-semibold small text-uppercase text-muted">Tanggal Kehilangan</label>
                                                                    <input required class="form-control form-control-lg border-0 bg-white shadow-sm" name="tglketinggalan" type="date" id="tglketinggalan" value="{{ old('tglketinggalan') }}">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="stasiun_id" class="form-label fw-semibold small text-uppercase text-muted">Stasiun</label>
                                                                    <select required class="form-select form-select-lg border-0 bg-white shadow-sm" name="stasiun_id" id="stasiun_id">
                                                                        <option selected disabled value="">Pilih Stasiun</option>
                                                                        @foreach ($stasiuns as $stasiun)
                                                                            <option value="{{ $stasiun->id }}" {{ old('stasiun_id') == $stasiun->id ? 'selected' : '' }}>{{ $stasiun->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="area_id" class="form-label fw-semibold small text-uppercase text-muted">Area Spesifik</label>
                                                                    <select required class="form-select form-select-lg border-0 bg-white shadow-sm" name="area_id" id="area_id">
                                                                        <option selected disabled value="">Pilih Area</option>
                                                                        @foreach ($areas as $area)
                                                                            <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label fw-semibold small text-uppercase text-muted" for="keteranganlain">Keterangan Tambahan (Opsional)</label>
                                                                    <textarea class="form-control border-0 bg-white shadow-sm" name="keteranganlain" id="keteranganlain" rows="2" placeholder="Informasi tambahan lain yang relevan...">{{ old('keteranganlain') }}</textarea>
                                                                </div>
                                                                <div class="col-12 mt-2">
                                                                    <label class="form-label fw-semibold small text-uppercase text-muted" for="kode_booking">Kode Booking (Opsional)</label>
                                                                    <input class="form-control form-control-lg border-0 bg-white shadow-sm @error('kode_booking') is-invalid @enderror" type="text" id="kode_booking" name="kode_booking" placeholder="Masukan Kode Booking tiket KAI anda jika ada..." value="{{ old('kode_booking') }}" />
                                                                    @error('kode_booking')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    <small class="text-muted"><i class="bx bx-info-circle me-1"></i>Hanya diisi jika anda melakukan perjalanan menggunakan kereta atau KRL.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Section: Bukti Foto -->
                                                    <div class="col-12">
                                                        <h6 class="fw-bold text-primary mb-3 mt-2"><i class='bx bx-images me-1'></i> Bukti Foto</h6>
                                                        <div class="bg-light p-3 rounded-3">
                                                            <div class="d-flex flex-column flex-md-row gap-4 align-items-start">
                                                                <div class="button-wrapper">
                                                                    <label for="upload" class="btn btn-primary btn-lg rounded-pill shadow-sm me-2 mb-3" tabindex="0">
                                                                        <i class="bx bx-upload me-1"></i>
                                                                        <span class="d-none d-sm-inline-block">Pilih Foto</span>
                                                                        <input type="file" name="foto[]" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" multiple required />
                                                                    </label>
                                                                    <button type="button" class="btn btn-outline-danger btn-lg rounded-pill shadow-sm account-image-reset mb-3" id="resetImage">
                                                                        <i class="bx bx-reset me-1"></i> Reset
                                                                    </button>
                                                                    <div class="text-muted small">
                                                                        <i class='bx bx-info-circle me-1'></i> Upload max 3 foto (JPG/PNG).
                                                                    </div>
                                                                </div>
                                                                <!-- Preview Container -->
                                                                <div id="preview-container" class="d-flex flex-wrap gap-2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-check mt-4 mb-4">
                                                    <input class="form-check-input checked" type="checkbox" name="checked" id="checked" required />
                                                    <label class="form-check-label text-muted" for="checked">
                                                        Saya menyatakan bahwa data yang saya isi adalah benar dan menyetujui <a href="#">Syarat & Ketentuan</a>.
                                                    </label>
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-lg hover-scale buat-aduan">
                                                        <i class='bx bx-send me-1'></i> Kirim Laporan Kehilangan
                                                    </button>
                                                </div>
                                            </form>

                                            <!-- Zoom Modal -->
                                            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                                        <img id="modalImage" src="" class="img-fluid rounded-3 shadow-lg" style="max-height: 80vh;" alt="Zoom">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                        <!-- /Account -->
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
                [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
            });
        </script>
        <!-- Script Preview + Reset + Pop-up -->
        <script>
            const uploadInput = document.getElementById('upload');
            const previewContainer = document.getElementById('preview-container');
            const modalImage = document.getElementById('modalImage');
            const resetBtn = document.getElementById('resetImage');

            // Preview gambar saat upload
            uploadInput.addEventListener('change', function(e) {
                const files = e.target.files;
                previewContainer.innerHTML = ''; // Clear previous previews

                if (files.length > 3) {
                    alert("Maksimal hanya 3 foto!");
                    uploadInput.value = '';
                    return;
                }

                if (files) {
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const imgContainer = document.createElement('div');
                            imgContainer.style.width = '150px';
                            imgContainer.style.height = '150px';
                            imgContainer.style.overflow = 'hidden';
                            imgContainer.style.display = 'flex';
                            imgContainer.style.alignItems = 'center';
                            imgContainer.style.justifyContent = 'center';
                            imgContainer.style.border = '1px solid #ccc';
                            imgContainer.style.borderRadius = '8px';
                            
                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '100%';
                            img.style.objectFit = 'contain';
                            img.style.cursor = 'pointer';
                            img.setAttribute('data-bs-toggle', 'modal');
                            img.setAttribute('data-bs-target', '#imageModal');
                            
                            img.addEventListener('click', function() {
                                modalImage.src = event.target.result;
                            });

                            imgContainer.appendChild(img);
                            previewContainer.appendChild(imgContainer);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            });

            // Reset gambar
            resetBtn.addEventListener('click', function() {
                uploadInput.value = '';
                previewContainer.innerHTML = '';
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.buat-aduan').addClass('disabled')
                $(".checked").change(function() {

                    if ($(".checked").is(':checked')) {
                        $('.buat-aduan').removeClass('disabled')
                    } else {
                        $('.buat-aduan').addClass('disabled')
                    }
                })
            });
        </script>

</body>

</html>