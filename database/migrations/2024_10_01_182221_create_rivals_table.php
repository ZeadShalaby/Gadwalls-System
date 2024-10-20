<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rivals', function (Blueprint $table) {
            $table->id();
            $table->String("rivalable_type");
            $table->bigInteger('rivalable_id')->unsigned()->nullable();
            $table->index('rivalable_id')->nullable();
            $table->String("rival")->nullable();   // ? discount = reval 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rivals');
    }
};
