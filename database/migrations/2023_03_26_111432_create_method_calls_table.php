<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Method;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('method_calls', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Method::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('lead_time_seconds');
            $table->unsignedBigInteger('memory_usage_bit');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('method_calls');
    }
};
