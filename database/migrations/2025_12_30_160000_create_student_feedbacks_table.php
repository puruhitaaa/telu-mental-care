<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_feedbacks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('consultation_id')->constrained('consultation_requests')->cascadeOnDelete();
    $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('counselor_id')->constrained('users')->cascadeOnDelete();
    $table->text('feedback');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_feedbacks');
    }
};
