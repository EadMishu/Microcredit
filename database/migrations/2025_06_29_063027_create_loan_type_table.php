<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('loan_type', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('percentage', 5, 2);
        $table->integer('duration');
        $table->integer('number_of_installments');
        $table->string('status');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('loan_type');
}
};
