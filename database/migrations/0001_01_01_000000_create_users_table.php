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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('member_number')->unique()->nullable();
            $table->string('name');
            $table->string('name_bn')->nullable();                       
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('husband_name')->nullable();
            $table->string('wife_name')->nullable();
            $table->string('occupation')->nullable();
            $table->string('dob')->nullable();
            $table->string('nid')->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->integer('member_fee')->nullable();
            $table->text('present_address')->nullable();
            $table->unsignedBigInteger('present_division')->nullable();
            $table->unsignedBigInteger('present_district')->nullable();
            $table->unsignedBigInteger('present_police_station')->nullable();
            $table->text('permanent_address')->nullable();
            $table->unsignedBigInteger('permanent_division')->nullable();
            $table->unsignedBigInteger('permanent_district')->nullable();
            $table->unsignedBigInteger('permanent_police_station')->nullable();
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('nationality')->nullable();
            $table->string('mobile_number')->unique();
            $table->string('mobile_number_2')->nullable();
            $table->string('mobile_number_3')->nullable();
            $table->string('image')->nullable();
            $table->string('signature')->nullable();
            $table->string('join_date')->nullable();
            $table->integer('role')->default(1)->comment('Member=1, Field Officer=2, Admin=3');
            $table->string('password');
            $table->integer('status')->default(1)->comment('Pending=1, Active=2, Closed=3');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('present_division')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('present_district')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('present_police_station')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('permanent_division')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('permanent_district')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('permanent_police_station')->references('id')->on('locations')->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('mobile_number')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
