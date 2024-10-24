@extends('Master.Layouts.app', ['title' => $title])

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Proposal</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-gray">Admin</li>
                <li class="breadcrumb-item active" aria-current="page">Proposal</li>
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
                                <th class="border-bottom-0">Jenis Proposal</th>
                                <th class="border-bottom-0">Nama Pengirim</th>
                                <th class="border-bottom-0">No. Telp</th>
                                <th class="border-bottom-0">Tanggal Dikirim</th>
                                <th class="border-bottom-0">Nama Penerima</th>
                                <th class="border-bottom-0">Alamat</th>
                                <th class="border-bottom-0">No. Telp</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Respon</th>
                                <th class="border-bottom-0">Tanggal Direspon</th>
                                <th class="border-bottom-0">Jumlah Donasi</th>
                                <th class="border-bottom-0">Keterangan</th>
                                <th class="border-bottom-0" width="1%">Aksi</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->

    @include('Admin.Proposal.tambah')
    @include('Admin.Proposal.edit')
    @include('Admin.Proposal.hapus')

    <script>
        function update(data) {
            $("input[name='idproposalU']").val(data.proposal_id);
            $("input[name='proposalU']").val(data.proposal_name.replace(/_/g, ' '));
            $("input[name='senderU']").val(data.proposal_sender.replace(/_/g, ' '));
            $("input[name='snotelpU']").val(data.proposal_sender_notelp);
            $("input[name='sentdateU']").val(data.proposal_sent_date);
            $("input[name='recipientU']").val(data.proposal_recipient_name.replace(/_/g, ' '));
            $("textarea[name='addressU']").val(data.proposal_recipient_address.replace(/_/g, ' '));
            $("input[name='rnotelpU']").val(data.proposal_recipient_notelp);
            $("select[name='statusU']").val(data.proposal_status.replace(/_/g, ' '));
            $("select[name='responseU']").val(data.proposal_response.replace(/_/g, ' '));
            $("input[name='responsedateU']").val(data.proposal_response_date);
            $("input[name='amountU']").val(data.proposal_amount_received);
            $("textarea[name='notesU']").val(data.proposal_notes.replace(/_/g, ' '));
        }

        function hapus(data) {
            $("input[name='idproposal']").val(data.proposal_id);
            $("#vproposal").html("proposal " + "<b>" + data.proposal_name.replace(/_/g, ' ') + "</b>");
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
                "url": "{{ route('proposal.getproposal') }}",
            },

            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'proposal_name',
                    name: 'proposal_name',
                },
                {
                    data: 'proposal_sender',
                    name: 'proposal_sender',
                },
                {
                    data: 'proposal_sender_notelp',
                    name: 'proposal_sender_notelp',
                },
                {
                    data: 'proposal_sent_date',
                    name: 'proposal_sent_date',
                },
                {
                    data: 'proposal_recipient_name',
                    name: 'proposal_recipient_name',
                },
                {
                    data: 'proposal_recipient_address',
                    name: 'proposal_recipient_address',
                },
                {
                    data: 'proposal_recipient_notelp',
                    name: 'proposal_recipient_notelp',
                },
                {
                    data: 'proposal_status',
                    name: 'proposal_status',
                },
                {
                    data: 'proposal_response',
                    name: 'proposal_response',
                },
                {
                    data: 'proposal_response_date',
                    name: 'proposal_response_date',
                },
                {
                    data: 'proposal_amount_received',
                    name: 'proposal_amount_received',
                },
                {
                    data: 'proposal_notes',
                    name: 'proposal_notes',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],

        });
    </script>
@endsection
