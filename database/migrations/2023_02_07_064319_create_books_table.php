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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('book_type')->default(false);
            $table->string('isbn')->unique()->nullable();
            $table->string('title');
            $table->string('tags');
            $table->date('release_date')->default(now());
            $table->string('publisher');
            $table->string('author');
            $table->longText('synopsis')->default('deskripsi belum ditulis....');
            $table->integer('remaining_books');
            $table->string('book_cover')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
