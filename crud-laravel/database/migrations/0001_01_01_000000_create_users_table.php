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
        // --------------------------
        // Tabela de usuários
        // --------------------------
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['user', 'admin', 'root'])->default('user'); // role do usuário
            $table->rememberToken();
            $table->timestamps();
        });

        // --------------------------
        // Tabela de cursos
        // --------------------------
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // --------------------------
        // Tabela de estudantes
        // --------------------------
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable();

            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // cada estudante pertence a um curso
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // usuário que cadastrou
            $table->timestamps();
        });

        // --------------------------
        // Tabela de password resets
        // --------------------------
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // --------------------------
        // Tabela de sessões
        // --------------------------
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};