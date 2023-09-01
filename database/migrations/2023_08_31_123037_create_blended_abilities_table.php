<?php

use App\Models\Portal\Item\Item;
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
        Schema::create('blended_abilities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Item::class);
            $table->integer('blended_idx');
            $table->integer('ap');
            $table->json('cost');
            $table->integer('act_rate');
            $table->integer('target_type');
            $table->json('effect1');
            $table->json('effect2');
            $table->json('effect3');
            $table->json('effect4');
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blended_abilities');
    }
};
