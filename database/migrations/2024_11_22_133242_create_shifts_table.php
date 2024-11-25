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
            $table->id(); // Define 'role' as the primary key
            $table->unsignedBigInteger('emp_id'); // Foreign key to users table
            $table->string('caregroup')->nullable(); //group that caregiver takes per day -serena
            // $table->timestamp('shift_date');
            $table->timestamp('shift_start');
            $table->timestamp('shift_end');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('emp_id')->references('emp_id')->on('employees')->onDelete('cascade');
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

