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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable();
            
            // Relacionamentos
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // cada estudante pertence a um curso
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // usuário que cadastrou

            $table->timestamps();
            $table->softDeletes(); // opcional, para permitir exclusão lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('students');
    }
};