<?php
// database/migrations/xxxx_xx_xx_create_node_types_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('node_types', function (Blueprint $table) {
            $table->string('type')->primary(); // pl: 'page'
            $table->string('title');          // pl: 'Oldal'
            $table->foreignId('site_id')->nullable()->constrained()->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('node_types');
    }
};
