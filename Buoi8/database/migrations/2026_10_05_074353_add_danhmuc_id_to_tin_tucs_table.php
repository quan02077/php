<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDanhmucIdToTinTucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            $table->foreignId('danhmuc_id')->nullable()->constrained('danh_mucs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            //
        });
    }
}
