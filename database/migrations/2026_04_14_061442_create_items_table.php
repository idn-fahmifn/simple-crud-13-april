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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();

            $table->foreignId('category_id')
            ->nullable() //category_id boleh dikosongkan
            ->constrained('categories') //berelasi dengan tabel category
            ->cascadeOnUpdate() //menjalar saat data category diubah
            // saat data kategory diubah, maka category id akan berubah menjadi null
            ->nullOnDelete(); 

            $table->string('item_name');
            $table->string('brand');
            $table->integer('stock');
            $table->string('image');
            $table->text('desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
