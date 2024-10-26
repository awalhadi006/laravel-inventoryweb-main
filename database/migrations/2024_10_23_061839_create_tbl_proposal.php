<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_proposal', function (Blueprint $table) {
            $table->increments('proposal_id');
            $table->string('proposal_name');
            $table->string('proposal_slug');
            $table->string('proposal_sender', 50);
            $table->string('proposal_sender_notelp', 13);
            $table->date('proposal_sent_date');
            $table->string('proposal_recipient_name', 50)->nullable();
            $table->string('proposal_recipient_address', 100)->nullable();
            $table->string('proposal_recipient_notelp', 13)->nullable();
            $table->enum('proposal_status', ['pribadi', 'masjid', 'majelis', 'yayasan'])->nullable();
            $table->enum('proposal_response', ['menunggu', 'diterima', 'ditolak'])->nullable();
            $table->date('proposal_response_date')->nullable();
            $table->bigInteger('proposal_amount_received')->nullable();
            $table->text('proposal_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_proposal');
    }
};
