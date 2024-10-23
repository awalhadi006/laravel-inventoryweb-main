<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalModel extends Model
{
    use HasFactory;
    protected $table = "tbl_proposal";
    protected $primaryKey = 'proposal_id';
    protected $fillable = [
        'proposal_name',
        'proposal_slug',
        'proposal_sender',
        'proposal_sender_notelp',
        'proposal_sent_date',
        'proposal_recipient_name',
        'proposal_recipient_address',
        'proposal_recipient_notelp',
        'proposal_status',
        'proposal_response',
        'proposal_response_date',
        'proposal_amount_received',
        'proposal_notes',
    ];
}
