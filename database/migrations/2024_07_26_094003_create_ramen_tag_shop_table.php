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
        Schema::create('ramen_tag_shop', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('ramen_tag_id')->canstrained('ramen_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ramen_tag_shop');
    }
};

