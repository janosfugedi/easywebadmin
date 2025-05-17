<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('block', function (Blueprint $table) {
            $table->id('bid');
            $table->foreignId('site_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete(); // creator
            $table->string('region', 64);
            $table->boolean('status')->default(false);
            $table->integer('weight')->default(0);
            $table->tinyInteger('custom')->default(0)->comment('0: fix, 1: látható, 2: rejtett');
            $table->tinyInteger('visibility')->default(0)->comment('0: minden oldalon, 1: csak felsorolt, 2: PHP kód alapján');
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('block');
    }
};
