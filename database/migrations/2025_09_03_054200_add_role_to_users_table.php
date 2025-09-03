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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['person', 'staff'])->default('person')->after('email');
        $table->string('faculty')->nullable()->after('role'); // สำหรับนิสิต/บุคลากร
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'faculty']);
    });
}
};
