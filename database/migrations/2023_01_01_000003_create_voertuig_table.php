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
        Schema::create('voertuig', function (Blueprint $table) {
            $table->id();
            $table->string('Kenteken');
            $table->string('Type');
            $table->date('Bouwjaar');
            $table->string('Brandstof');
            $table->foreignId('TypeVoertuigId')->constrained('type_voertuig');
            
            // Systeemvelden
            $table->boolean('IsActief')->default(true);
            $table->text('Opmerking')->nullable();
            $table->timestamp('DatumAangemaakt')->useCurrent();
            $table->timestamp('DatumGewijzigd')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voertuig');
    }
};
