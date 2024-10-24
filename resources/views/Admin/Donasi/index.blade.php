@extends('Master.Layouts.app', ['title' => $title])

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Galang Dana</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-gray">Admin</li>
                <li class="breadcrumb-item active" aria-current="page">Galang Dana</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->


    <!-- ROW -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Data</h3>
                    @if ($hakTambah > 0)
                        <div>
                            <a class="modal-effect btn btn-primary-light" data-bs-effect="effect-super-scaled"
                                data-bs-toggle="modal" href="#modaldemo8">Tambah Data
                                <i class="fe fe-plus"></i></a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-1" width="100%"
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <th class="border-bottom-0" width="1%">No</th>
                                <th class="border-bottom-0">Nama Penanggung Jawab</th>
                                <th class="border-bottom-0">Nama Anggota</th>
                                <th class="border-bottom-0">Lokasi</th>
                                <th class="border-bottom-0">Alamat</th>
                                <th class="border-bottom-0">Tanggal Pelaksanaan</th>
                                <th class="border-bottom-0">Keterangan</th>
                                <th class="border-bottom-0">Jumlah Donasi</th>
                                <th class="border-bottom-0" width="1%">Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->

    @include('Admin.Donasi.tambah')
    @include('Admin.Donasi.edit')
    @include('Admin.Donasi.hapus')

    <script>
        function update(data) {
            $("input[name='iddonasiU']").val(data.donasi_id);
            $("input[name='donasiU']").val(data.donasi_pj.replace(/_/g, ' '));
            $("textarea[name='anggotaU']").val(data.donasi_anggota.replace(/_/g, ' '));
            $("input[name='lokasiU']").val(data.donasi_lokasi.replace(/_/g, ' '));
            $("input[name='alamatU']").val(data.donasi_alamat.replace(/_/g, ' '));
            $("input[name='tanggalU']").val(data.donasi_tanggal);
            $("select[name='keteranganU']").val(data.donasi_keterangan.replace(/_/g, ' '));
            $("input[name='jumlahU']").val(data.donasi_jumlah);
        }

        function hapus(data) {
            $("input[name='iddonasi']").val(data.donasi_id);
            $("#vdonasi").html("donasi " + "<b>" + data.donasi_pj.replace(/_/g, ' ') + "</b>");
        }

        function validasi(judul, status) {
            swal({
                title: judul,
                type: status,
                confirmButtonText: "Iya."
            });
        }
    </script>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table;
        $(document).ready(function() {
            //datatables
            table = $('#table-1').DataTable({

                "processing": true,
                "serverSide": true,
                "info": true,
                "order": [],
                "stateSave": true,
                "lengthMenu": [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ],
                "pageLength": 10,

                lengthChange: true,

                "ajax": {
                    "url": "{{ route('donasi.getdonasi') }}",
                },

                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'donasi_pj',
                        name: 'donasi_pj',
                    },
                    {
                        data: 'donasi_anggota',
                        name: 'donasi_anggota',
                    },
                    {
                        data: 'donasi_lokasi',
                        name: 'donasi_lokasi',
                    },
                    {
                        data: 'donasi_alamat',
                        name: 'donasi_alamat',
                    },
                    {
                        data: 'donasi_tanggal',
                        name: 'donasi_tanggal',
                    },
                    {
                        data: 'donasi_keterangan',
                        name: 'donasi_keterangan',
                    },
                    {
                        data: 'donasi_jumlah',
                        name: 'donasi_jumlah',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });
        });
    </script>
@endsection
