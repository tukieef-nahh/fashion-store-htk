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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenSP')->nullable(false);
            $table->string('slug')->nullable();
            $table->text('moTa')->nullable(false);
            $table->decimal('gia', 8, 2)->nullable(false);
            $table->integer('soLuong')->default(0);
            $table->unsignedInteger('danh_muc_id');
            $table->unsignedInteger('thuong_hieu_id');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('danh_muc_id')->references('id')->on('danh_mucs')->onDelete('cascade');
            $table->foreign('thuong_hieu_id')->references('id')->on('thuong_hieus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
