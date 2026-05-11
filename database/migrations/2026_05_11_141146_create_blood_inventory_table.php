<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('blood_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('blood_group');
            $table->integer('units_available')->default(0);
            $table->integer('units_reserved')->default(0);
            $table->date('last_updated')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('blood_inventory');
    }
};
