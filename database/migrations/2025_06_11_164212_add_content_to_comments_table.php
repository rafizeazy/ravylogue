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
        Schema::table('comments', function (Blueprint $table) {
            // Periksa apakah kolom 'content' belum ada sebelum menambahkannya
            if (!Schema::hasColumn('comments', 'content')) {
                $table->text('content')->after('post_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Periksa apakah kolom 'content' ada sebelum menghapusnya
            if (Schema::hasColumn('comments', 'content')) {
                $table->dropColumn('content');
            }
        });
    }
};
