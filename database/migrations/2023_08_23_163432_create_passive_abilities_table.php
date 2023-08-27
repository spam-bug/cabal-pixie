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
        Schema::connection('web')->create('passive_abilities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Item::class);
            $table->integer('force_code');
            $table->integer('value_type');
            $table->string('icon');
            $table->integer('max_level');
            $table->integer('total_ap_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passive_abilities');
    }
};
