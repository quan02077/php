<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassNameToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Thêm cột class_name kiểu chuỗi, cho phép null hoặc đặt sau cột email
            $table->string('class_name')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Hủy cột class_name nếu chạy lệnh rollback
            $table->dropColumn('class_name');
        });
    }
}
