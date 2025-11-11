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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->integer('score')->default(0);
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->enum('joined_via', ['code', 'admin']); // track how they joined
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->decimal('percentage', 5, 2)->default(0); // 
            $table->string('name')->nullable()->constrained()->onDelete('cascade');
            $table->string('code')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
