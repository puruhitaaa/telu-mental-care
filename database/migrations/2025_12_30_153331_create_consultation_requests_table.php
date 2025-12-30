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
    Schema::create('consultation_requests', function (Blueprint $table) {
        $table->id();

        $table->foreignId('student_id')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->foreignId('counselor_id')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete();

        $table->string('topic');
        $table->date('preferred_date');
        $table->time('preferred_time');

        $table->enum('urgency', ['low', 'medium', 'high']);
        $table->enum('communication', ['chat', 'video', 'offline']);

        $table->enum('status', [
            'pending',
            'approved',
            'completed',
            'cancelled'
        ])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('consultation_requests');
}
};
