<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAdditionalImagesFromArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('additional_images'); // Menghapus kolom additional_images
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->json('additional_images')->nullable(); // Mengembalikan kolom jika rollback
        });
    }
}
