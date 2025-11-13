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

                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <h4 class="card-header fw-bold py-3 mb-3">
                                        <span class="text-muted fw-light">ADUAN ID :</span> {{ $aduan->id }}
                                    </h4>
                                    <div class="card-body">
                                        <div class="mb-2 col-12 mb-0">
                                            @if ($aduan->status =='0' )
                                            <div class="alert alert-warning">
                                                <h6 class="alert-heading fw-bold mb-1">
                                                    Aduan kamu sedang di proses !
                                                </h6>
                                                <p class="mb-0 text-dark">
                                                    Silakan tunggu informasi lebih lanjut. Jika ada pertanyaan,
                                                    hubungi customer service di bawah.
                                                </p>
                                            </div>
                                            @elseif ($aduan->status =='1' )
                                            <div class="alert alert-success">
                                                <h6 class="alert-heading fw-bold ">
                                                    Aduan kamu berhasil di terima , berikut kami lampirkan barag yang
                                                    sesuai dengan aduan kamu
                                                </h6>
                                                <p class="mb-3 text-gray">
                                                    Jika barang yang ditampilkan sesuai dengan milikmu, silakan lakukan klaim kepemilikan melalui tombol di bawah.
                                                </p>
                                            </div>
                                            @else <div class="alert alert-danger">
                                                <h6 class="alert-heading fw-bold ">
                                                    Maaf.. sepertinya laporan kamu masih belum sesuai
                                                </h6>
                                            </div>
                                            @endif




                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>

                        {{-- items --}}
                        @if ($aduan->status =='1' )
                        <div class="row">
                            @foreach ($items as $item )
                            <div class="col-md-3 col-lg-3 mb-3">
                                <div class="card h-100">
                                    <img class="card-img-top" style="height:200px"
                                        src="{{ Storage::url('public/assets/img/items/').$item->foto }}"
                                        alt="Card image cap">
                                    <div class="card-body">

                                        <span class="card-title d-block">Nama Barang : {{ $item->namabarang }}</span>
                                        <span class="card-title d-block">Kategori : {{ $item->kategori?->nama ?? 'N/A' }}</span>
                                        <span class="card-title d-block">Lokasi : {{ $item->stasiun?->nama ?? 'N/A' }}</span>
                                        @if ($aduan->status =='1')
                                        <form action="{{ route('claimaduan') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="aduan_id" value="{{ $aduan->id }}">
                                            <input type="hidden" name="barang_id" value="{{ $item->id }}">
                                            <button type="submit" href="{{ route('claimaduan') }}"
                                                class="btn btn-danger">
                                                Claim Kepemilikan
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @endif
                        {{-- /items --}}

                        {{-- form aduan --}}
                        @if ($aduan->status =='0' )
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        {{-- Form tidak perlu action karena semua field readonly --}}
                                        <form>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="namabarang" class="form-label">
                                                        Nama Barang :
                                                    </label>
                                                    <input class="form-control" type="text" id="namabarang" readonly
                                                        name="namabarang" value="{{ $aduan->namabarang }}" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="kategori" class="form-label">Kategori :</label>

                                                    <input class="form-control" type="text" id="kategori" readonly
                                                        value="{{ $aduan->kategori?->nama ?? 'N/A' }}" />
                                                </div>

                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label" for="phoneNumber">
                                                        Deskripsi Barang :
                                                    </label>
                                                    <textarea readonly class="form-control" name="deskripsi"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{ $aduan->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="tanggalkehilangan" class="form-label">
                                                        Tanggal Kehilangan :
                                                    </label>
                                                    <input class="form-control" value="{{ $aduan->tglketinggalan }}" readonly
                                                        name="tanggalkehilangan" type="date" id="tanggalkehilangan">
                                                </div>

                                                <div class="mb-3 col-md-3">
                                                    <label for="stasiun" class="form-label">
                                                        Stasiun Kehilangan
                                                    </label>

                                                    <input class="form-control" type="text" id="stasiun" readonly
                                                        value="{{ $aduan->stasiun?->nama ?? 'N/A' }}" />
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label for="area" class="form-label">
                                                        Area
                                                    </label>

                                                    <input class="form-control" type="text" id="area" readonly
                                                        value="{{ $aduan->area?->nama ?? 'N/A' }}" />
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="keteranganlain" class="form-label">Deskipsi
                                                        keterangan
                                                        lain</label>
                                                    <input class="form-control" type="text" id="keteranganlain" readonly
                                                        value="{{ $aduan->keteranganlain }}" />
                                                </div>



                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img src="{{ Storage::url('public/assets/img/aduan/').$aduan->foto }}"
                                                        alt="" class="d-block rounded" height="100" width="100"
                                                        id="uploadedAvatar" />

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif
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