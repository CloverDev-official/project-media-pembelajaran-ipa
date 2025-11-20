<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru')->insert([
            [
                'email' => 'guru1@example.com',
                'nama' => 'Budi Santoso',
                'password' => bcrypt('1'),
            ],
            [
                'email' => 'guru2@example.com',
                'nama' => 'Siti Aminah',
                'password' => bcrypt('1'),
            ],
            [
                'email' => 'guru3@example.com',
                'nama' => 'Andi Wijaya',
                'password' => bcrypt('1'),
            ],
        ]);
    }
}
