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



        //Test1
        /*
        User::create([
            'fullname' => 'Test1',
            'email' => 'test1@ni.com',
            'password' => Hash::make('12345678'),
            'tipo_documento' => 'cedula_ciudadana',
            'num_documento' => 123456789,
            'ciudad_residencia' => 'ciudad',
            'admin' => '0',
            'direccion_residencia' => 'direccion residencia',
            'celular' => 04141234567,
            'banco' => 'Bancolombia',
            'tipo_cuenta' => 'corriente',
            'num_cuenta' => '0000-0000-000000000000',
        ]);

        //Test2
        User::create([
            'fullname' => 'Test2',
            'email' => 'test2@ni.com',
            'password' => Hash::make('12345678'),
            'tipo_documento' => 'cedula_extranjera',
            'num_documento' => 123456789,
            'ciudad_residencia' => 'ciudad 2',
            'admin' => '0',
            'direccion_residencia' => 'direccion residencia 2',
            'celular' => 04121234567,
            'banco' => 'Banco A v Villas',
            'tipo_cuenta' => 'ahorro',
            'num_cuenta' => '0000-1111-000000000000',
        ]);

        //Test3
        User::create([
            'fullname' => 'Test3',
            'email' => 'test3@ni.com',
            'password' => Hash::make('12345678'),
            'tipo_documento' => 'pasaporte',
            'num_documento' => 1234567890,
            'ciudad_residencia' => 'ciudad 3',
            'admin' => '0',
            'direccion_residencia' => 'direccion residencia 3',
            'celular' => 04121234567,
            'banco' => 'Davivienda',
            'tipo_cuenta' => 'corriente',
            'num_cuenta' => '1111-0000-000000000000',
        ]);
        */
    }
}
