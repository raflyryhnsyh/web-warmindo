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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('category_name');
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu'); 
            $table->string('menu_name')->index();
            $table->double('price');
            $table->string('description');
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')
                ->references('id_category')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(['menu', 'categories']);
    }
};
