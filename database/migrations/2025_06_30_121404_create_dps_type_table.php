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
        Schema::create('dps_type', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('percentage', 5, 2);
        $table->integer('duration');
        $table->integer('number_of_installments');
        $table->string('status');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dps_type');
    }
};
