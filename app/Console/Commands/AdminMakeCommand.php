<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminMakeCommand
 * @package App\Console\Commands
 */
class AdminMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создать нового админа';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        do {
            $details = $this->askForUserDetails($details ?? null);

            $name = $details['name'];
            $email = $details['email'];
            $password = $details['password'];

        } while (!$this->confirm("Создать нового пользователя: {$name} <{$email}>?", true));


        $user = Admin::forceCreate([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $this->info("Создан новый пользователь #{$user->id}");
    }

    /**
     * @param null $defaults
     * @return array
     */
    protected function askForUserDetails($defaults = null)
    {
        $name = $this->ask('Полное имя нового пользователя?', $defaults['name'] ?? null);
        $email = $this->askUniqueEmail('Email адрес нового пользователя?', $defaults['email'] ?? null);
        $password = $this->ask('Пароль нового пользователя?', $defaults['password'] ?? null);

        return compact('name', 'email', 'password');
    }

    /**
     * @param $message
     * @param null $default
     * @return mixed
     */
    protected function askUniqueEmail($message, $default = null)
    {
        do {
            $email = $this->ask($message, $default);
        } while (!$this->checkEmailIsValid($email) || !$this->checkEmailIsUnique($email));

        return $email;
    }

    /**
     * @param $email
     * @return bool
     */
    protected function checkEmailIsValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Email адрес, "' . $email . '" не валиден!');
            return false;
        }

        return true;
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkEmailIsUnique($email)
    {
        if ($existingUser = Admin::whereEmail($email)->first()) {
            $this->error('Email адрес, "' . $existingUser->email . '" уже используется ' . $existingUser->name . '!');
            return false;
        }
        return true;
    }

}
