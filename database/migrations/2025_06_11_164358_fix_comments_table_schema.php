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
            // Hanya coba rename jika kolom 'body' ada DAN kolom 'content' TIDAK ada.
            if (Schema::hasColumn('comments', 'body') && !Schema::hasColumn('comments', 'content')) {
                $table->renameColumn('body', 'content');
            }
            // Jika kolom 'body' dan 'content' keduanya ada, hapus 'body' untuk konsistensi.
            elseif (Schema::hasColumn('comments', 'body') && Schema::hasColumn('comments', 'content')) {
                $table->dropColumn('body');
            }
            // Jika hanya 'content' yang belum ada, buat kolom tersebut.
            elseif (!Schema::hasColumn('comments', 'content')) {
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
            // Logika rollback yang aman: hanya ubah nama jika 'content' ada dan 'body' tidak ada.
            if (Schema::hasColumn('comments', 'content') && !Schema::hasColumn('comments', 'body')) {
                $table->renameColumn('content', 'body');
            }
        });
    }
};
