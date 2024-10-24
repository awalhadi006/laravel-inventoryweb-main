<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\DonasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DonasiController extends Controller
{
    public function index()
    {
        $data["title"] = "Galang Dana";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Galang Dana', 'tbl_akses.akses_type' => 'create'))->count();
        return view('Admin.Donasi.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = DonasiModel::orderBy('donasi_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $array = array(
                        "donasi_id" => $row->donasi_id,
                        "donasi_pj" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->donasi_pj)),
                        "donasi_anggota" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->donasi_anggota)),
                        "donasi_lokasi" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->donasi_lokasi)),
                        "donasi_alamat" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->donasi_alamat)),
                        "donasi_tanggal" => $row->donasi_tanggal,
                        "donasi_keterangan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->donasi_keterangan)),
                        "donasi_jumlah" => $row->donasi_jumlah,
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Galang Dana', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Galang Dana', 'tbl_akses.akses_type' => 'delete'))->count();
                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit > 0 && $hakDelete == 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit == 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else {
                        $button .= '-';
                    }
                    return $button;
                })
                ->rawColumns(['action'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->donasi)));

        //insert data
        DonasiModel::create([
            'donasi_pj' => $request->donasi,
            'donasi_slug' => $slug,
            'donasi_anggota' => $request->anggota,
            'donasi_lokasi' => $request->lokasi,
            'donasi_alamat' => $request->alamat,
            'donasi_tanggal' => $request->tanggal,
            'donasi_keterangan' => $request->keterangan,
            'donasi_jumlah' => $request->jumlah,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, DonasiModel $donasi)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->donasi)));

        //update data
        $donasi->update([
            'donasi_pj' => $request->donasi,
            'donasi_slug' => $slug,
            'donasi_anggota' => $request->anggota,
            'donasi_lokasi' => $request->lokasi,
            'donasi_alamat' => $request->alamat,
            'donasi_tanggal' => $request->tanggal,
            'donasi_keterangan' => $request->keterangan,
            'donasi_jumlah' => $request->jumlah,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, DonasiModel $donasi)
    {
        //delete
        $donasi->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
