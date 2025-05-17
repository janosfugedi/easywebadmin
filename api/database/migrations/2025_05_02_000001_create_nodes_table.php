<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('node', function (Blueprint $table) {
            $table->id('nid');
            $table->unsignedBigInteger('vid')->nullable()->unique();
            $table->string('type');
            $table->foreignId('site_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete(); // creator
            $table->boolean('published')->default(false);
            $table->timestamps();

            $table->index(['site_id', 'type']);
            $table->index(['type', 'nid']);
        });

        Schema::create('node_revisions', function (Blueprint $table) {
            $table->id('vid');
            $table->foreignId('nid')->constrained('node', 'nid')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete(); // editor
            $table->string('title');
            $table->longText('body')->nullable();
            $table->longText('log')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('node_revisions');
        Schema::dropIfExists('node');
    }
};
