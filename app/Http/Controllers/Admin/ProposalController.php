<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\ProposalModel;
use App\Traits\HasFormatNomor;
use App\Traits\HasFormatRupiah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProposalController extends Controller
{
    use HasFormatRupiah;
    use HasFormatNomor;
    public function index()
    {
        $data["title"] = "Proposal";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Proposal', 'tbl_akses.akses_type' => 'create'))->count();
        return view('Admin.Proposal.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = ProposalModel::orderBy('proposal_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('proposal_recipient_name', function ($row) {
                    $recip_name = $row->proposal_recipient_name == '' ? '-' : $row->proposal_recipient_name;

                    return $recip_name;
                })
                ->addColumn('proposal_recipient_address', function ($row) {
                    $alamat = $row->proposal_recipient_address == '' ? '-' : $row->proposal_recipient_address;

                    return $alamat;
                })

                ->addColumn('proposal_status', function ($row) {
                    $status = $row->proposal_status == '' ? '-' : $row->proposal_status;

                    return $status;
                })

                ->addColumn('proposal_sent_date', function ($row) {
                    $sent_date = $row->proposal_sent_date == '' ? '-' : Carbon::parse($row->proposal_sent_date)->translatedFormat('d F Y');

                    return $sent_date;
                })

                ->addColumn('proposal_response_date', function ($row) {
                    $resp_date = $row->proposal_response_date == '' ? '-' : Carbon::parse($row->proposal_response_date)->translatedFormat('d F Y');

                    return $resp_date;
                })

                ->addColumn('proposal_notes', function ($row) {
                    $notes = $row->proposal_notes == '' ? '-' : $row->proposal_notes;

                    return $notes;
                })

                ->addColumn('action', function ($row) {
                    $array = array(
                        "proposal_id" => $row->proposal_id,
                        "proposal_name" => trim(preg_replace('/[^A-Za-z0-9-.]+/', '_', $row->proposal_name)),
                        "proposal_sender" => trim(preg_replace('/[^A-Za-z0-9-.]+/', '_', $row->proposal_sender)),
                        "proposal_sender_notelp" => $row->proposal_sender_notelp,
                        "proposal_sent_date" => $row->proposal_sent_date,
                        "proposal_recipient_name" => trim(preg_replace('/[^A-Za-z0-9-.]+/', '_', $row->proposal_recipient_name)),
                        "proposal_recipient_address" => trim(preg_replace('/[^A-Za-z0-9-.]+/', '_', $row->proposal_recipient_address)),
                        "proposal_recipient_notelp" => $row->proposal_recipient_notelp,
                        "proposal_status" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->proposal_status)),
                        "proposal_response" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->proposal_response)),
                        "proposal_response_date" => $row->proposal_response_date,
                        "proposal_amount_received" => $row->proposal_amount_received,
                        "proposal_notes" => trim(preg_replace('/[^A-Za-z0-9-.]+/', '_', $row->proposal_notes)),
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Proposal', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Proposal', 'tbl_akses.akses_type' => 'delete'))->count();
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
                ->editColumn('proposal_sender_notelp', function ($row) {
                    return $row->proposal_sender_notelp == '' ? '-' : $this->formatNomor($row->proposal_sender_notelp);
                })
                ->editColumn('proposal_recipient_notelp', function ($row) {
                    return $row->proposal_recipient_notelp == '' ? '-' : $this->formatNomor($row->proposal_recipient_notelp);
                })
                ->editColumn('proposal_amount_received', function ($row) {
                    return $row->proposal_amount_received == '' ? '-' : $this->formatRupiah($row->proposal_amount_received);
                })
                ->rawColumns(['action', 'recip_name', 'alamat', 'status', 'sent_date', 'resp_date', 'notes'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->proposal)));

        //insert data
        ProposalModel::create([
            'proposal_name' => $request->proposal,
            'proposal_slug' => $slug,
            'proposal_sender' => $request->sender,
            'proposal_sender_notelp' => $request->snotelp,
            'proposal_sent_date' => $request->sentdate,
            'proposal_recipient_name' => $request->recipient,
            'proposal_recipient_address' => $request->address,
            'proposal_recipient_notelp' => $request->rnotelp,
            'proposal_status' => $request->status,
            'proposal_response' => $request->response,
            'proposal_response_date' => $request->responsedate,
            'proposal_amount_received' => $request->amount,
            'proposal_notes' => $request->notes,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, ProposalModel $proposal)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->proposal)));

        //update data
        $proposal->update([
            'proposal_name' => $request->proposal,
            'proposal_slug' => $slug,
            'proposal_sender' => $request->sender,
            'proposal_sender_notelp' => $request->snotelp,
            'proposal_sent_date' => $request->sentdate,
            'proposal_recipient_name' => $request->recipient,
            'proposal_recipient_address' => $request->address,
            'proposal_recipient_notelp' => $request->rnotelp,
            'proposal_status' => $request->status,
            'proposal_response' => $request->response,
            'proposal_response_date' => $request->responsedate,
            'proposal_amount_received' => $request->amount,
            'proposal_notes' => $request->notes,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, ProposalModel $proposal)
    {
        //delete
        $proposal->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
