<?php

use App\Models\Portal\Ability\PassiveAbility;
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
        Schema::connection('web')->create('passive_ability_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PassiveAbility::class);
            $table->integer('level');
            $table->integer('ap');
            $table->integer('item1_idx');
            $table->integer('item1_option');
            $table->integer('item1_count');
            $table->integer('item2_idx');
            $table->integer('item2_option');
            $table->integer('item2_count');
            $table->integer('force_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passive_ability_values');
    }
};
