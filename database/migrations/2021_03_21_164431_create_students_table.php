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

            $table->bigInteger('group_id')
                ->unsigned()
                ->nullable();
            $table->foreign('group_id')
                ->references('id')
                ->on('groups');

            $table->string('name')
                ->nullable()
                ->comment('Имя студента');

            $table->string('password');

            $table->string('surname')
                ->nullable()
                ->comment('Фамилия студента');

            $table->string('email')
                ->unique()
                ->comment('E-mail при регистрации');

            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('Поле подтверждения E-mail');

            $table->rememberToken()
                ->comment('Для хранения токена, пользователей, выбравших вариант "Запомнить меня"');
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
