<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_attachment', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('tag_id')->unsigned();
            $table->bigInteger('attachment_id')->unsigned();

            # Make foreign keys
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('attachment_id')->references('id')->on('attachments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_attachment');
    }
};
