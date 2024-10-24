<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Galang Dana</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="iddonasiU">
                <div class="form-group">
                    <label for="donasiU" class="form-label">Nama Penanggung Jawab<span
                            class="text-danger">*</span></label>
                    <input type="text" name="donasiU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="anggotaU" class="form-label">Nama Anggota</label>
                    <textarea name="anggotaU" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="lokasiU" class="form-label">Lokasi Galang Dana</label>
                    <input type="text" name="lokasiU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="alamatU" class="form-label">Alamat</label>
                    <input type="text" name="alamatU" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tanggalU" class="form-label">Tanggal Pelaksanaan</label>
                    <input type="date" name="tanggalU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="keteranganU" class="form-label">Keterangan</label>
                    <select name="keteranganU" class="form-control">
                        <option value="">Pilih Keterangan</option>
                        <option value="sudah">Sudah Dikonfirmasi</option>
                        <option value="belum">Belum Dikonfirmasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlahU" class="form-label">Jumlah Donasi</label>
                    <input type="text" name="jumlahU" class="form-control">
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
            const donasi = $("input[name='donasiU']").val();
            setLoadingU(true);
            resetValidU();

            if (donasi == "") {
                validasi('Nama Penanggung Jawab wajib di isi!', 'warning');
                $("input[name='donasiU']").addClass('is-invalid');
                setLoadingU(false);
                return false;
            } else {
                submitFormU();
            }
        }

        function submitFormU() {
            const id = $("input[name='iddonasiU']").val();
            const donasi = $("input[name='donasiU']").val();
            const anggota = $("textarea[name='anggotaU']").val();
            const lokasi = $("input[name='lokasiU']").val();
            const alamat = $("input[name='alamatU']").val();
            const tanggal = $("input[name='tanggalU']").val();
            const keterangan = $("select[name='keteranganU']").val();
            const jumlah = $("input[name='jumlahU']").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/donasi/proses_ubah') }}/" + id,
                enctype: 'multipart/form-data',
                data: {
                    _token: "{{ csrf_token() }}",
                    donasi: donasi,
                    anggota: anggota,
                    lokasi: lokasi,
                    alamat: alamat,
                    tanggal: tanggal,
                    keterangan: keterangan,
                    jumlah: jumlah,
                },
                success: function(data) {
                    swal({
                        title: "Berhasil diubah!",
                        type: "success"
                    });
                    $('#Umodaldemo8').modal('toggle');
                    table.ajax.reload(null, false);
                    resetU();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    setLoadingU(false);
                }
            });
        }

        function resetValidU() {
            $("input[name='donasiU']").removeClass('is-invalid');
            $("textarea[name='anggotaU']").removeClass('is-invalid');
        };

        function resetU() {
            resetValidU();
            $("input[name='iddonasiU']").val('');
            $("input[name='donasiU']").val('');
            $("textarea[name='anggotaU']").val('');
            $("input[name='lokasiU']").val('');
            $("input[name='alamatU']").val('');
            $("input[name='tanggalU']").val('');
            $("select[name='keteranganU']").val('');
            $("input[name='jumlahU']").val('');
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
