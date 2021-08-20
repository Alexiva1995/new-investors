<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            'fullname' => 'Admin NI',
            'email' => 'admin@ni.com',
            'password' => Hash::make('12345678'),
            'tipo_documento' => 'cedula_ciudadana',
            'admin' => '1',
            'num_documento' => 123456789,
            'ciudad_residencia' => 'ciudad',
            'tipo_documento' => 'cedula_ciudadana',
            'direccion_residencia' => 'direccion residencia',
            'celular' => 1561453,
            'banco' => 'banco',
            'tipo_cuenta' => 'corriente',
            'num_cuenta' => 566535745,
            'banco' => 'banco',
        ];

        User::create($user);
    }
}
