<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin SIAPIT',
            'username' => 'admin',
            'email' => 'admin@siapit.com',
            'role' => 'super_admin',
            'password' => bcrypt('password123'),
        ]);

        $ay = \App\Models\AcademicYear::create([
            'name' => '2026/2027',
            'is_active' => true
        ]);

        \App\Models\Batch::create([
            'academic_year_id' => $ay->id,
            'name' => 'Gelombang 1',
            'is_active' => true
        ]);

        $beasiswa = \App\Models\EducationProgram::create([
            'name' => 'Beasiswa Pondok IT',
            'description' => 'Program beasiswa penuh 3 tahun, 1 tahun pendidikan karakter, skill, dan lifeskill, serta 2 tahun pengabdian',
            'duration_years' => 3
        ]);

        $berbayar = \App\Models\EducationProgram::create([
            'name' => 'Berbayar Rumah IT',
            'description' => 'Program berbayar 1 tahun pendidikan karakter, skill, dan lifeskill',
            'duration_years' => 1
        ]);

        \App\Models\Major::create([
            'education_program_id' => $beasiswa->id,
            'name' => 'Pemrograman',
            'description' => 'Jurusan Pemrograman jalur Beasiswa Pondok IT.'
        ]);

        \App\Models\Major::create([
            'education_program_id' => $berbayar->id,
            'name' => 'Pemrograman',
            'description' => 'Jurusan Pemrograman jalur Berbayar Rumah IT.'
        ]);

        \App\Models\Major::create([
            'education_program_id' => $beasiswa->id,
            'name' => 'Bisnis Digital',
            'description' => 'Jurusan Bisnis Digital jalur Beasiswa Pondok IT.'
        ]);

        \App\Models\Major::create([
            'education_program_id' => $berbayar->id,
            'name' => 'Bisnis Digital',
            'description' => 'Jurusan Bisnis Digital jalur Berbayar Rumah IT.'
        ]);
    }
}
