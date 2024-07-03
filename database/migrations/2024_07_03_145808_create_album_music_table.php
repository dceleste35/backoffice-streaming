<?php

use App\Models\Album;
use App\Models\Music;
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
        Schema::create('album_music', function (Blueprint $table) {
            $table->foreignIdFor(Album::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Music::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['album_id', 'music_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_music');
    }
};
