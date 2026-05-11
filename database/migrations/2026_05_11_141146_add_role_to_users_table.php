<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'donor', 'hospital'])->default('donor')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->string('blood_group')->nullable()->after('phone');
            $table->text('address')->nullable()->after('blood_group');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'blood_group', 'address']);
        });
    }
};
