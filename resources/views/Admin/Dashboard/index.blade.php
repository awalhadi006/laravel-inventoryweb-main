@extends('Master.Layouts.app', ['title' => $title])

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-gray">Admin</li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW 1 OPEN -->
    <div class="row">
        <div>
            <h3>
                <a href="{{ route('proposal.index') }}" class="fw-semibold">Proposal</a>
            </h3>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $proposal }}</h2>
                            <p class="text-white mb-0">Proposal Keluar </p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-file text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info img-card box-info-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $proposal_diterima }}</h2>
                            <p class="text-white mb-0">Proposal Diterima</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-file text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-danger img-card box-danger-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $proposal_ditolak }}</h2>
                            <p class="text-white mb-0">Proposal Ditolak</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-file text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card  bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $proposal_donasi }}</h2>
                            <p class="text-white mb-0">Total Donasi</p>
                        </div>
                        <div class="ms-auto"> <i class="ti ti-report-money text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>
    <!-- ROW 1 CLOSED -->
    <!-- ROW 1 OPEN -->
    <div class="row">
        <div>
            <h3>
                <a href="{{ route('donasi.index') }}" class="fw-semibold">Galang Dana</a>
            </h3>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $donasi_minggu_ini }}</h2>
                            <p class="text-white mb-0">Minggu Ini</p>
                        </div>
                        <div class="ms-auto"> <i class="ti ti-building-mosque text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info img-card box-info-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $donasi_minggu_depan }}</h2>
                            <p class="text-white mb-0">Minggu Depan</p>
                        </div>
                        <div class="ms-auto"> <i class="ti ti-building-mosque text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-danger img-card box-danger-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $donasi_terlaksana }}</h2>
                            <p class="text-white mb-0">Sudah Terlaksana</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-check-circle text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card  bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $donasi_jumlah }}</h2>
                            <p class="text-white mb-0">Total Donasi</p>
                        </div>
                        <div class="ms-auto"> <i class="ti ti-report-money text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>
    <!-- ROW 1 CLOSED -->
@endsection
