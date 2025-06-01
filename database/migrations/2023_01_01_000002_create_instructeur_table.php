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
        Schema::create('instructeur', function (Blueprint $table) {
            $table->id();
            $table->string('Voornaam');
            $table->string('Tussenvoegsel')->nullable();
            $table->string('Achternaam');
            $table->string('Mobiel');
            $table->date('DatumInDienst');
            $table->string('AantalSterren');
            
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
        Schema::dropIfExists('instructeur');
    }
};
