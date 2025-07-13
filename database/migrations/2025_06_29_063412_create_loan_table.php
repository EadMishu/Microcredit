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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->string('loan_number')->unique(); // Unique loan identifier
            $table->string('amount')->nullable();

            $table->unsignedBigInteger('user_id'); // Foreign key to users (via user_number)
            $table->unsignedBigInteger('loan_type_id'); // Foreign key to loan_type

            $table->date('open_date')->nullable();
            $table->date('close_date')->nullable();
            $table->date('closed_date')->nullable();

            $table->integer('status')->default(1)->comment('1 = Pending, 2 = Running, 3 = Closed');

            $table->timestamps();

            // Foreign key constraints
            // If 'user_id' references 'user_number' in users, type must match (usually user_number would be string)
            // Otherwise, it should reference 'id' in users (adjust accordingly)

            // Example: referencing users.id (more typical)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('loan_type_id')->references('id')->on('loan_type')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan');
    }
};
