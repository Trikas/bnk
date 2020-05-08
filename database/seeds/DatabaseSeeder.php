<?php

use App\Account;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "user",
            'username' => "user",
            'last_name' => 'userof',
            'email' => "user@user.com",
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);


        DB::table('users')->insert([
            'name' => "admin",
            'username' => "admin",
            'last_name' => 'Adminovych',
            'email' => "admin@admin.com",
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);



        Eloquent::unguard();

        $user = User::whereRole('user')->orderBy('id', 'asc')->first();

        $type = \App\Accounttype::create([
            'user_id' => $user->id,
            'title' => 'Текущие счета/Сберегательные/Счета до востребования'
        ]);

        $type_2 = \App\Accounttype::create([
            'user_id' => $user->id,
            'title' => 'Текущие/Счета до востребования'
        ]);



        Account::create([
            'user_id' => $user->id,
            'currency_id' => 1,
            'iban' => 'CY89008001700000000001955310',
            'number' => sprintf('%04d%04d%04d%04d%04d',
                rand(1, 9999), rand(1, 9999), rand(1, 9999), rand(1, 9999), rand(1, 9999)),
            'personality' => Account::PERSONALITY_LEGAL,
            'balance_current' => 300,
            'accounttype_id' => $type->id
        ]);

        Account::create([
            'user_id' => $user->id,
            'currency_id' => 2,
            'iban' => 'CY8900800170000000001242342',
            'number' => sprintf('%04d%04d%04d%04d%04d',
                rand(1, 9999), rand(1, 9999), rand(1, 9999), rand(1, 9999), rand(1, 9999)),
            'personality' => Account::PERSONALITY_LEGAL,
            'balance_current' => 50,
            'accounttype_id' => $type->id
        ]);
    }
}
