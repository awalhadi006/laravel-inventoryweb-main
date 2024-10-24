<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Proposal</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idproposalU">
                <div class="form-group">
                    <label for="proposalU" class="form-label">Jenis Proposal<span class="text-danger">*</span></label>
                    <input type="text" name="proposalU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="senderU" class="form-label">Nama Pengirim</label>
                    <input type="text" name="senderU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="snotelpU" class="form-label">No Telp</label>
                    <input type="text" name="snotelpU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="sentdateU" class="form-label">Tanggal Dikirim</label>
                    <input type="date" name="sentdateU" class="form-control">
                </div>
                <div class="form-group">
                    <label for="recipientU" class="form-label">Nama Penerima</label>
                    <input type="text" name="recipientU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="addressU" class="form-label">Alamat</label>
                    <textarea name="addressU" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="rnotelpU" class="form-label">No Telp</label>
                    <input type="text" name="rnotelpU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="statusU" class="form-label">Status</label>
                    <select name="statusU" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="pribadi">Pribadi</option>
                        <option value="masjid">Masjid</option>
                        <option value="majels">Majels</option>
                        <option value="yayasan">Yayasan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="responseU" class="form-label">Respon</label>
                    <select name="responseU" class="form-control">
                        <option value="">Pilih Respon</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="responsedateU" class="form-label">Tanggal Respon</label>
                    <input type="date" name="responsedateU" class="form-control">
                </div>
                <div class="form-group">
                    <label for="amountU" class="form-label">Jumlah Donasi</label>
                    <input type="text" name="amountU" class="form-control" data-mask="#.##0" data-mask-reverse="true"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label for="notesU" class="form-label">Catatan</label>
                    <textarea name="notesU" class="form-control" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success d-none" id="btnLoaderU" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkFormU()" id="btnSimpanU" class="btn btn-success">Simpan
                    Perubahan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="resetU()" data-bs-dismiss="modal">Batal
                    <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formEditJS')
    <script>
        function checkFormU() {
            const proposal = $("input[name='proposalU']").val();
            setLoadingU(true);
            resetValidU();

            if (proposal == "") {
                validasi('Nama Proposal wajib di isi!', 'warning');
                $("input[name='proposalU']").addClass('is-invalid');
                setLoadingU(false);
                return false;
            } else {
                submitFormU();
            }
        }

        function submitFormU() {
            const id = $("input[name='idproposalU']").val();
            const proposal = $("input[name='proposalU']").val();
            const sender = $("input[name='senderU']").val();
            const snotelp = $("input[name='snotelpU']").val();
            const sentdate = $("input[name='sentdateU']").val();
            const recipient = $("input[name='recipientU']").val();
            const address = $("textarea[name='addressU']").val();
            const rnotelp = $("input[name='rnotelpU']").val();
            const status = $("input[name='statusU']").val();
            const response = $("input[name='responseU']").val();
            const responsedate = $("input[name='responsedateU']").val();
            const amount = $("input[name='amountU']").val().replace(/\./g, '');
            const notes = $("textarea[name='notesU']").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/proposal/proses_ubah') }}/" + id,
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
                    swal({
                        title: "Berhasil diubah!",
                        type: "success"
                    });
                    $('#Umodaldemo8').modal('toggle');
                    table.ajax.reload(null, false);
                    resetU();
                }
            });
        }

        function resetValidU() {
            $("input[name='proposalU']").removeClass('is-invalid');
            $("input[name='senderU']").removeClass('is-invalid');
        };

        function resetU() {
            resetValidU();
            $("input[name='idproposalU']").val('');
            $("input[name='proposalU']").val('');
            $("input[name='senderU']").val('');
            $("input[name='snotelpU']").val('');
            $("input[name='sentdateU']").val('');
            $("input[name='recipientU']").val('');
            $("textarea[name='addressU']").val('');
            $("input[name='rnotelpU']").val('');
            $("select[name='statusU']").val('');
            $("select[name='responseU']").val('');
            $("input[name='responsedateU']").val('');
            $("input[name='amountU']").val('');
            $("textarea[name='notesU']").val('');
            setLoadingU(false);
        }

        function setLoadingU(bool) {
            if (bool == true) {
                $('#btnLoaderU').removeClass('d-none');
                $('#btnSimpanU').addClass('d-none');
            } else {
                $('#btnSimpanU').removeClass('d-none');
                $('#btnLoaderU').addClass('d-none');
            }
        }
    </script>
@endsection
