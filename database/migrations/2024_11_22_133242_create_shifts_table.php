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
        Schema::create('shifts', function (Blueprint $table) {
            $table->string('role')->primary(); // Define 'role' as the primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('name');
            $table->timestamp('shift_start');
            $table->timestamp('shift_end');
            $table->string('patient_group');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};

