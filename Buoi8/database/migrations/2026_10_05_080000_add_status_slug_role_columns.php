<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusSlugRoleColumns extends Migration
{
    public function up(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (!Schema::hasColumn('tin_tucs', 'slug')) {
                $table->string('slug', 255)->nullable()->unique()->after('tieude');
            }
            if (!Schema::hasColumn('tin_tucs', 'trang_thai')) {
                $table->enum('trang_thai', ['draft', 'published'])->default('draft')->after('ngaydang');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'editor', 'user'])->default('user')->after('email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (Schema::hasColumn('tin_tucs', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('tin_tucs', 'trang_thai')) {
                $table->dropColumn('trang_thai');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
}
