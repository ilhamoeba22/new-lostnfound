<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-{{ asset('assets')
    }}-path="{{ asset('assets') }}/" data-template="vertical-menu-template-free">

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
                            <span class="text-muted fw-light">Detail Barang /</span>
                            Kode Barang
                        </h4>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">


                                    <div class="card-body p-4">
                                        <h4 class="fw-bold text-primary mb-4">Formulir Klaim Barang</h4>
                                        <div class="alert alert-info rounded-3 mb-4 d-flex align-items-center">
                                            <i class="bx bx-info-circle fs-4 me-2"></i>
                                            <div>Harap isi data dengan benar. Data yang Anda kirim akan diverifikasi oleh Admin.</div>
                                        </div>

                                        <form method="POST" action="{{ route('postclaim') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="aduan_id" value="{{ $aduan }}">
                                            <input type="hidden" name="barang_id" value="{{ $items }}">

                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <h6 class="fw-bold text-dark mb-3"><i class='bx bx-user me-1'></i> Identitas Pengklaim</h6>
                                                    <div class="bg-light p-3 rounded-3">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold small text-uppercase text-muted" for="basic-default-name">Nama Lengkap</label>
                                                                <input type="text" class="form-control form-control-lg border-0 bg-white shadow-sm" name="nama"
                                                                    id="basic-default-name" placeholder="Masukan nama lengkap Anda" required />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold small text-uppercase text-muted" for="basic-default-company">Alamat</label>
                                                                <input type="text" class="form-control form-control-lg border-0 bg-white shadow-sm" name="alamat"
                                                                    id="basic-default-company" placeholder="Alamat sesuai KTP" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h6 class="fw-bold text-dark mb-3 mt-2"><i class='bx bx-message-detail me-1'></i> Detail Klaim</h6>
                                                    <div class="bg-light p-3 rounded-3">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold small text-uppercase text-muted" for="basic-default-message">Pesan / Alasan Klaim</label>
                                                            <textarea id="basic-default-message" name="catatan" class="form-control border-0 bg-white shadow-sm" 
                                                                rows="3" placeholder="Jelaskan kenapa barang ini milik Anda (ciri khusus, isi, dll)..." required></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h6 class="fw-bold text-dark mb-3 mt-2"><i class='bx bx-images me-1'></i> Bukti Kepemilikan</h6>
                                                    <div class="bg-light p-3 rounded-3">
                                                        <div class="d-flex flex-column flex-md-row gap-4 align-items-start">
                                                            <div class="button-wrapper">
                                                                <label for="upload" class="btn btn-primary btn-lg rounded-pill shadow-sm me-2 mb-3" tabindex="0">
                                                                    <i class="bx bx-upload me-1"></i>
                                                                    <span class="d-none d-sm-inline-block">Pilih Bukti Foto</span>
                                                                    <input type="file" id="upload" name="foto[]" class="account-file-input" hidden accept="image/png, image/jpeg" multiple required>
                                                                </label>
                                                                <button type="button" class="btn btn-outline-danger btn-lg rounded-pill shadow-sm account-image-reset mb-3" id="resetImage">
                                                                    <i class="bx bx-reset me-1"></i> Reset
                                                                </button>
                                                                <div class="text-muted small">
                                                                    <i class='bx bx-info-circle me-1'></i> Upload max 3 foto (KTP, Bukti beli, dll).
                                                                </div>
                                                            </div>
                                                            <!-- Preview Container -->
                                                            <div id="preview-container" class="d-flex flex-wrap gap-2"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" required>
                                                        <label class="form-check-label text-muted" for="accountActivation">
                                                            Saya menyatakan bahwa data di atas benar dan saya bersedia bertanggung jawab secara hukum jika melakukan klaim palsu.
                                                        </label>
                                                    </div>
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-lg hover-scale">
                                                            <i class='bx bx-check-shield me-1'></i> Ajukan Klaim Barang
                                                        </button>
                                                    </div>
                                                </div>
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

                                    <!-- /Account -->
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
                        imgContainer.style.width = '100px';
                        imgContainer.style.height = '100px';
                        imgContainer.style.overflow = 'hidden';
                        imgContainer.style.display = 'flex';
                        imgContainer.style.alignItems = 'center';
                        imgContainer.style.justifyContent = 'center';
                        imgContainer.style.border = '1px solid #dee2e6'; // Bootstrap gray-300
                        imgContainer.style.borderRadius = '0.375rem'; // rounded-3
                        imgContainer.style.backgroundColor = '#f8f9fa'; // bg-light
                        
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
</body>

</html>