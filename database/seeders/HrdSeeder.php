<?php

namespace Database\Seeders;

use App\Models\Hrd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HrdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $senior = Hrd::create([
                'name'     => 'Mr. John',
                'username' => 'john',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            ]);
    
            $senior->assignRole('senior-hrd');
    
            $senior = Hrd::create([
                'name'     => 'Mrs. Lee',
                'username' => 'lee',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            ]);
    
            $senior->assignRole('hrd');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
}
