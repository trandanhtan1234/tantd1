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
        Schema::create('variant_value', function (Blueprint $table) {
            $table->integer('variant_id')->unsigned();
            $table->foreign('variant_id')->references('id')->on('variant')->onDelete('cascade');
            $table->integer('value_id')->unsigned();
            $table->foreign('value_id')->references('id')->on('values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_value');
    }
};
