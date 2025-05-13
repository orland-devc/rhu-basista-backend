<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pregnancy_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obstetric_sheet_id')->constrained()->onDelete('cascade');
            $table->string('pregnancy_order'); // G1, G2...
            $table->string('aog')->nullable(); // Age of Gestation
            $table->string('manner_of_delivery')->nullable();
            $table->string('place_of_delivery')->nullable();
            $table->string('gender')->nullable();
            $table->string('weight')->nullable();
            $table->string('complications')->nullable();
            $table->string('status')->nullable(); // e.g., Alive, Stillbirth
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pregnancy_records');
    }
};
