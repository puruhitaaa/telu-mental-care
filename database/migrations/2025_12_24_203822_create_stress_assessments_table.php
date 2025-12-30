<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('stress_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained('users')->onDelete('cascade');

        $table->tinyInteger('q1'); // overwhelmed
        $table->tinyInteger('q2'); // anxious
        $table->tinyInteger('q3'); // concentration
        $table->tinyInteger('q4'); // sleep quality
        $table->tinyInteger('q5'); // mental exhaustion

        $table->tinyInteger('stress_score'); // hasil total / avg
        $table->string('stress_level'); // Low / Medium / High

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stress_assessments');
    }
};
