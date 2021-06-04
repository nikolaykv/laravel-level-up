<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Внешний ключ учебных групп <belongsTo>
            $table->foreignId('group_id')
                ->nullable()
                ->constrained('groups')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Внешний ключ для учебных предметов <belongsTo>
            $table->foreignId('subject_id')
                ->nullable()
                ->constrained('subjects')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->integer('academic_grade')->nullable()
                ->comment('Оценка студенту по предмету');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
