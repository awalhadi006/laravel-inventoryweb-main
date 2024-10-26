<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Galang Dana</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="donasi" class="form-label">Nama Penanggung Jawab<span
                            class="text-danger">*</span></label>
                    <input type="text" name="donasi" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="anggota" class="form-label">Nama Anggota<span class="text-danger">*</span></label>
                    <textarea name="anggota" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="lokasi" class="form-label">Lokasi Galang Dana<span
                            class="text-danger">*</span></label>
                    <input type="text" name="lokasi" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat Galang Donasi<span
                            class="text-danger">*</span></label>
                    <input type="text" name="alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tanggal" class="form-label">Tanggal Pelaksanaan<span
                            class="text-danger">*</span></label>
                    <input type="text" name="tanggal" class="form-control datepicker-date" placeholder="">
                </div>
                <div class="form-group">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <select name="keterangan" class="form-control">
                        <option value="">Pilih Keterangan</option>
                        <option value="Belum terlaksana">Belum terlaksana</option>
                        <option value="Sudah terlaksana">Sudah terlaksana</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah" class="form-label">Jumlah Donasi</label>
                    <input type="text" name="jumlah" class="form-control" data-mask="#.##0" data-mask-reverse="true"
                        placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoader" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan <i
                        class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="reset()" data-bs-dismiss="modal">Batal
                    <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>


@section('formTambahJS')
    <script>
        function checkForm() {
            const donasi = $("input[name='donasi']").val();
            setLoading(true);
            resetValid();

            if (donasi == "") {
                validasi('Nama PIC wajib diisi!', 'warning');
                $("input[name='donasi']").addClass('is-invalid');
                setLoading(false);
                return false;
            }
            if (anggota == "") {
                validasi('Nama Anggota wajib diisi!', 'warning');
                $("textarea[name='anggota']").addClass('is-invalid');
                setLoading(false);
                return false;
            }
            if (lokasi == "") {
                validasi('Nama lokasi wajib diisi!', 'warning');
                $("input[name='lokasi']").addClass('is-invalid');
                setLoading(false);
                return false;
            }
            if (alamat == "") {
                validasi('Alamat wajib diisi!', 'warning');
                $("input[name='alamat']").addClass('is-invalid');
                setLoading(false);
                return false;
            }
            if (tanggal == "") {
                validasi('Tanggal wajib diisi!', 'warning');
                $("input[name='tanggal']").addClass('is-invalid');
                setLoading(false);
                return false;
            } else {
                submitForm();
            }

        }

        function submitForm() {
            const donasi = $("input[name='donasi']").val();
            const anggota = $("textarea[name='anggota']").val();
            const lokasi = $("input[name='lokasi']").val();
            const alamat = $("input[name='alamat']").val();
            const tanggal = $("input[name='tanggal']").val();
            const keterangan = $("select[name='keterangan']").val();
            const jumlah = $("input[name='jumlah']").val().replace(/\./g, '');

            $.ajax({
                type: 'POST',
                url: "{{ route('donasi.store') }}",
                enctype: 'multipart/form-data',
                data: {
                    donasi: donasi,
                    anggota: anggota,
                    lokasi: lokasi,
                    alamat: alamat,
                    tanggal: tanggal,
                    keterangan: keterangan,
                    jumlah: jumlah,
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
            $("input[name='donasi']").removeClass('is-invalid');
        };

        function reset() {
            resetValid();
            $("input[name='donasi']").val('');
            $("textarea[name='anggota']").val('');
            $("input[name='lokasi']").val('');
            $("input[name='alamat']").val('');
            $("input[name='tanggal']").val('');
            $("select[name='keterangan']").val('');
            $("input[name='jumlah']").val('');
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
