<?php

use App\Models\Portal\Ability\BlendedAbility;
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
        Schema::create('blended_ability_recipes', function (Blueprint $table) {
            $table->id();
            $table->integer('rate');
            $table->integer('alz');
            $table->json('material1');
            $table->json('material2');
            $table->json('material3');
            $table->integer('result_index');
            $table->foreignIdFor(BlendedAbility::class);
            $table->string('name_key');
            $table->string('name_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blended_ability_recipes');
    }
};
