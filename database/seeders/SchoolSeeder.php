<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Session;
use Database\Factories\SchoolFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::factory()
            ->create([
                'name' => 'Collège Fontanes - 79000 Niort',
                'phone' => '0549773200',
                'email' => 'ce.0790709s@ac-poitiers.fr',
                'contact' => 'Infirmière scolaire',
            ]);
        School::factory()
            ->create([
                'name' => 'Collège Henri Martineau - 79160 Coulonges sur l\Autize',
                'phone' => '0549061110',
                'email' => 'ce.0790016n@ac-poitiers.fr',
                'contact' => 'Principal établissement',
            ]);
    }
}
