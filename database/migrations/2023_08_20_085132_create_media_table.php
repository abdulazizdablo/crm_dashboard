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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->string('name');
            $table->string('collection_name');
$table->string('conversions_disk');
$table->string('custom_properties');
$table->string('generated_conversions');
$table->string('responsive_images');
$table->string('manipulations');
$table->string('uuid');

            $table->bigInteger('model_id');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('disk');
            $table->integer('order_column');
            $table->unsignedInteger('size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
