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
        Schema::create('dps', function (Blueprint $table) {
        $table->id();

            $table->string('dps_number')->unique(); // Unique loan identifier
            
            $table->string('amount')->nullable();
            $table->string('dps_fee')->nullable();
            $table->string('service_charge')->nullable();
            $table->string('stamp_charge')->nullable();

            $table->unsignedBigInteger('user_id'); // Foreign key to users (via member_number)
            $table->unsignedBigInteger('dps_type_id'); // Foreign key to loan_type
            
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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('dps_type_id')->references('id')->on('dps_type')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dps');
    }
};