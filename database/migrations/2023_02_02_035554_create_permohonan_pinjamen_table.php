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
        Schema::create('permohonan_pinjamen', function (Blueprint $table) {
            $table->id();
            $table->biginteger('nasabah_id');
            $table->biginteger('besar_pinjaman');
            $table->string('janis');
            $table->string('lama_pinjaman');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('permohonan_pinjamen');
    }
};
