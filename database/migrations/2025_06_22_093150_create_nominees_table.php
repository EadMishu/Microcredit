<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nominees', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('name');           // 1. Nominee Name
        $table->string('relation')->nullable();               // 2. Relation
        $table->date('dob')->nullable();  // 3. Date of birth
        $table->string('nid')->nullable();        // 4. NID
        // Present Address
        $table->text('present_address')->nullable();      // 5
        $table->unsignedBigInteger('present_division')->nullable();   // 6
        $table->unsignedBigInteger('present_district')->nullable();   // 7
        $table->unsignedBigInteger('present_police_station')->nullable(); // 8
        // Permanent Address
        $table->text('permanent_address')->nullable();    // 9
        $table->unsignedBigInteger('permanent_division')->nullable(); // 10
        $table->unsignedBigInteger('permanent_district')->nullable(); // 11
        $table->unsignedBigInteger('permanent_police_station')->nullable(); // 12
        $table->string('image')->nullable();      // 13. Nominee Image
        $table->timestamps();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('present_division')->references('id')->on('locations')->onDelete('cascade');
        $table->foreign('present_district')->references('id')->on('locations')->onDelete('cascade');
        $table->foreign('present_police_station')->references('id')->on('locations')->onDelete('cascade');
        $table->foreign('permanent_division')->references('id')->on('locations')->onDelete('cascade');
        $table->foreign('permanent_district')->references('id')->on('locations')->onDelete('cascade');
        $table->foreign('permanent_police_station')->references('id')->on('locations')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('nominees');
    }
};
