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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name', 40)->unique();
            $table->string('contact_email', 40)->unique();
            $table->string('company_address', 255);
            $table->string('company_city', 40);
            $table->string('company_name', 40);
            $table->string('contact_phone_number', 40);
            $table->string('company_zip', 40);
            $table->string('company_vat');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
