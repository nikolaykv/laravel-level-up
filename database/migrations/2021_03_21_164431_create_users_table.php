<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->nullable()
                ->comment('Имя пользователя');


            $table->string('surname')
                ->nullable()
                ->comment('Фамилия пользователя');

            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('Поле подтверждения E-mail');

            $table->string('password')
                ->default('123')
                ->comment('Пароль пользователя');


            $table->string('email')
                ->unique()
                ->default('student@student.com')
                ->comment('E-mail пользователя');

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
        Schema::dropIfExists('users');
    }
}
