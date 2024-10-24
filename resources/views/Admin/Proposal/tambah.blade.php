<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Proposal</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6" style="padding-right: 15px; border-right: 2px solid rgba(0, 0, 0, 0.5);">
                        <div class="form-group">
                            <label for="proposal" class="form-label">Jenis Proposal<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="proposal" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="sender" class="form-label">Nama Pengirim</label>
                            <input type="text" name="sender" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="snotelp" class="form-label">No Telp</label>
                            <input type="text" name="snotelp" class="form-control" data-mask="0000-0000-00000"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="sentdate" class="form-label">Tanggal Dikirim</label>
                            <input type="text" name="sentdate" class="form-control datepicker-date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient" class="form-label">Nama Penerima</label>
                            <input type="text" name="recipient" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rnotelp" class="form-label">No Telp</label>
                            <input type="text" name="rnotelp" class="form-control" data-mask="0000-0000-00000"
                                placeholder="">
                        </div>
                        <div class="form-group mb-5">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="pribadi">Pribadi</option>
                                <option value="masjid">Masjid</option>
                                <option value="majels">Majels</option>
                                <option value="yayasan">Yayasan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="border-top: 2px solid rgba(0, 0, 0, 0.5);">
                        <label for="response" class="form-label mt-5">Respon</label>
                        <select name="response" class="form-control">
                            <option value="">Pilih Respon</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="responsedate" class="form-label">Tanggal Respon</label>
                        <input type="text" name="responsedate" class="form-control datepicker-date">
                    </div>
                    <div class="form-group">
                        <label for="amount" class="form-label">Jumlah Donasi</label>
                        <input type="text" name="amount" class="form-control" data-mask="#.##0"
                            data-mask-reverse="true" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="notes" class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoader" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan
                    <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="reset()" data-bs-dismiss="modal">Batal
                    <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>


@section('formTambahJS')
    <script>
        function checkForm() {
            const proposal = $("input[name='proposal']").val();
            setLoading(true);
            resetValid();

            if (proposal == "") {
                validasi('Nama Proposal wajib di isi!', 'warning');
                $("input[name='proposal']").addClass('is-invalid');
                setLoading(false);
                return false;
            } else {
                submitForm();
            }

        }

        function submitForm() {
            const proposal = $("input[name='proposal']").val();
            const sender = $("input[name='sender']").val();
            const snotelp = $("input[name='snotelp']").val().replace(/\-/g, '');
            const sentdate = $("input[name='sentdate']").val();
            const recipient = $("input[name='recipient']").val();
            const address = $("textarea[name='address']").val();
            const rnotelp = $("input[name='rnotelp']").val().replace(/\-/g, '');
            const status = $("select[name='status']").val();
            const response = $("select[name='response']").val();
            const responsedate = $("input[name='responsedate']").val();
            const amount = $("input[name='amount']").val().replace(/\./g, '');
            const notes = $("textarea[name='notes']").val();


            $.ajax({
                type: 'POST',
                url: "{{ route('proposal.store') }}",
                enctype: 'multipart/form-data',
                data: {
                    proposal: proposal,
                    sender: sender,
                    snotelp: snotelp,
                    sentdate: sentdate,
                    recipient: recipient,
                    address: address,
                    rnotelp: rnotelp,
                    status: status,
                    response: response,
                    responsedate: responsedate,
                    amount: amount,
                    notes: notes,
                },
                success: function(data) {
                    $('#modaldemo8').modal('toggle');
                    swal({
                        title: "Berhasil ditambah!",
                        type: "success"
                    });
                    table.ajax.reload(null, false);
                    reset();

                }
            });
        }

        function resetValid() {
            $("input[name='proposal']").removeClass('is-invalid');
        };

        function reset() {
            resetValid();
            $("input[name='proposal']").val('');
            $("input[name='sender']").val('');
            $("input[name='snotelp']").val('');
            $("input[name='sentdate']").val('');
            $("input[name='recipient']").val('');
            $("textarea[name='address']").val('');
            $("input[name='rnotelp']").val('');
            $("select[name='status']").val('');
            $("select[name='response']").val('');
            $("input[name='responsedate']").val('');
            $("input[name='amount']").val('');
            $("textarea[name='notes']").val('');
            setLoading(false);
        }

        function setLoading(bool) {
            if (bool == true) {
                $('#btnLoader').removeClass('d-none');
                $('#btnSimpan').addClass('d-none');
            } else {
                $('#btnSimpan').removeClass('d-none');
                $('#btnLoader').addClass('d-none');
            }
        }
    </script>
@endsection
