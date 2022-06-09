<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder {
    public function run()
    {
        User::truncate();

        User::create([
            'surname' => 'Иванов',
            'name' => 'Иван',
            'third_name' => 'Иванович',
            'birthday' => '1990-01-01',
            'address' => 'г.Полоцк, ул.Мариненко, д.1',
            'rank' => 'admin',
            'contact_info' => '+375337777777',
            'passport_info' => 'BM1111111',
            'username' => 'admin',
            'password' => 'mrap8f',
        ]);
    }
}
