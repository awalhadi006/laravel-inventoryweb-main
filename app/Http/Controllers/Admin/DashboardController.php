<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\CustomerModel;
use App\Models\Admin\DonasiModel;
use App\Models\Admin\JenisBarangModel;
use App\Models\Admin\MerkModel;
use App\Models\Admin\ProposalModel;
use App\Models\Admin\SatuanModel;
use App\Models\Admin\UserModel;
use App\Traits\HasFormatRupiah;
use Carbon\Carbon;

class DashboardController extends Controller
{
    use HasFormatRupiah;
    public function index()
    {
        $data["title"] = "Dashboard";
        $data["proposal"] = ProposalModel::orderBy('proposal_id', 'DESC')->count();
        $data["proposal_diterima"] = ProposalModel::where('proposal_response', 'diterima')->count();
        $data["proposal_ditolak"] = ProposalModel::where('proposal_response', 'ditolak')->count();
        $data["proposal_donasi"] = $this->formatRupiah(ProposalModel::sum('proposal_amount_received'));

        $data["donasi_minggu_ini"] = DonasiModel::whereBetween('donasi_tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data["donasi_minggu_depan"] = DonasiModel::whereBetween('donasi_tanggal', [Carbon::now()->addWeek()->startOfWeek(), Carbon::now()->addWeek()->endOfWeek()])->count();
        $data["donasi_terlaksana"] = DonasiModel::where('donasi_keterangan', 'Sudah Terlaksana')->count();
        $data["donasi_jumlah"] = $this->formatRupiah(DonasiModel::sum('donasi_jumlah'));

        $data["jenis"] = JenisBarangModel::orderBy('jenisbarang_id', 'DESC')->count();
        $data["satuan"] = SatuanModel::orderBy('satuan_id', 'DESC')->count();
        $data["merk"] = MerkModel::orderBy('merk_id', 'DESC')->count();
        $data["barang"] = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')->leftJoin('tbl_merk', 'tbl_merk.merk_id', '=', 'tbl_barang.merk_id')->orderBy('barang_id', 'DESC')->count();
        $data["customer"] = CustomerModel::orderBy('customer_id', 'DESC')->count();
        $data["bm"] = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')->leftJoin('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_barangmasuk.customer_id')->orderBy('bm_id', 'DESC')->count();
        $data["bk"] = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')->orderBy('bk_id', 'DESC')->count();
        $data["user"] = UserModel::leftJoin('tbl_role', 'tbl_role.role_id', '=', 'tbl_user.role_id')->select()->orderBy('user_id', 'DESC')->count();
        return view('Admin.Dashboard.index', $data);
    }
}
