<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDataGuru extends Seeder
{
    public function run(): void
    {
        DB::table('guru')->insert([
            [
                'email' => 'ahmadsmpn11@gmail.com',
                'nama' => 'Ahmad Zainudin',
                'password' => bcrypt('1'),
            ],
        ]);
    }
}
