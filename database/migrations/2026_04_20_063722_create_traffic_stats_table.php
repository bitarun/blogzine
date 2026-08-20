<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('traffic_stats', function (Blueprint $table) {
            $table->id();
            $table->date('visit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('traffic_stats');
    }
};
