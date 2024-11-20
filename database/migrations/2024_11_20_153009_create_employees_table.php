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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('emp_id')->unique();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            // $table->foreignId('user_id')->constrained('users', 'user_id'); // foreign key to users table           
            $table->decimal('salary', 11, 2);
            $table->timestamps();


            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
