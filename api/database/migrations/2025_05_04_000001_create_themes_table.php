<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Technikai név
            $table->string('title'); // Emberbarát név (pl. Octarine)
            $table->json('regions'); // Milyen régiókat támogat (pl. ["header", "footer"])
            $table->json('assets')->nullable(); // JS/CSS fájlok (pl. { "css": [...], "js": [...] })

            $table->enum('status', ['available', 'custom', 'disabled'])->default('available');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
