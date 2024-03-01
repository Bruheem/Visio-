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
        Schema::create('weeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('global_week_id')->constrained('global_weeks','id');
            $table->integer('week_number');
            $table->foreignId('battalion_id')->constrained('battalions')->onDelete('CASCADE');
            $table->date('start_week_date');
            $table->date('end_week_date');
            $table->char('semester',1);
            $table->string('week_type');
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};


