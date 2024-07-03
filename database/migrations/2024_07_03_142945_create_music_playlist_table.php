<?php

use App\Models\Music;
use App\Models\Playlist;
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
        Schema::create('music_playlist', function (Blueprint $table) {
            $table->foreignIdFor(Music::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Playlist::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['music_id', 'playlist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_playlist');
    }
};
