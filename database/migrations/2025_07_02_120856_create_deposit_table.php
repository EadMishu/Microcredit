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
        Schema::create('deposit', function (Blueprint $table) {
            $table->id();
            $table->string('deposit_number')->unique(); // Unique loan identifier
            $table->string('amount')->nullable();

            $table->unsignedBigInteger('member_id'); // Foreign key to users (via member_number)
            $table->unsignedBigInteger('deposit_type_id'); // Foreign key to loan_type
            
            $table->date('open_date')->nullable();
            $table->date('close_date')->nullable();
            $table->date('closed_date')->nullable();
            $table->string('note')->nullable();

            $table->integer('status')->default(1)->comment('1 = Pending, 2 = Running, 3 = Closed');

            $table->timestamps();

            // Foreign key constraints
            // If 'member_id' references 'member_number' in users, type must match (usually member_number would be string)
            // Otherwise, it should reference 'id' in users (adjust accordingly)

            // Example: referencing users.id (more typical)
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('deposit_type_id')->references('id')->on('deposit_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit');
    }
};
